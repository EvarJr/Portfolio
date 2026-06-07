/**
 * generate.js — ATS Resume DOCX Generator
 * Usage: node generate.js '<json>' '/output/path.docx'
 */

const DOCX_PATH = 'docx';
const {
    Document, Packer, Paragraph, TextRun, Table, TableRow, TableCell,
    AlignmentType, BorderStyle, WidthType, TabStopType, LevelFormat
} = require(DOCX_PATH);
const fs = require('fs');

// Read data from JSON file (avoids shell quoting issues)
const inputFile  = process.argv[2];
const outputFile = process.argv[3];
const data = JSON.parse(fs.readFileSync(inputFile, 'utf8'));
const { header={}, summary={}, history=[], education=[], tech=[], skills=[], languages=[], certifications=[] } = data;

const PAGE_WIDTH  = 12240;
const PAGE_HEIGHT = 15840;
const MARGIN      = 1080;
const CONTENT_W   = PAGE_WIDTH - MARGIN * 2;
const FONT        = 'Calibri';
const HS          = s => s * 2;
const C_BLACK     = '1A1A1A';
const C_DARK      = '333333';
const C_MUTED     = '666666';
const C_LINE      = '1A1A1A';

function spacer(b=0,a=0){ return new Paragraph({children:[new TextRun('')],spacing:{before:b,after:a}}); }

function sectionHeading(txt){
    return new Paragraph({
        children:[new TextRun({text:txt.toUpperCase(),bold:true,size:HS(10),font:FONT,color:C_BLACK,characterSpacing:40})],
        spacing:{before:200,after:80},
        border:{bottom:{style:BorderStyle.SINGLE,size:8,color:C_LINE,space:4}}
    });
}

function twoColRow(left,right,bold=true){
    return new Paragraph({
        tabStops:[{type:TabStopType.RIGHT,position:CONTENT_W}],
        children:[
            new TextRun({text:left,bold,size:HS(11),font:FONT,color:C_BLACK}),
            new TextRun({text:'\t'+right,size:HS(9.5),font:FONT,color:C_MUTED})
        ],
        spacing:{before:0,after:20}
    });
}

function italicLine(txt){
    return new Paragraph({
        children:[new TextRun({text:txt,italics:true,size:HS(10),font:FONT,color:C_DARK})],
        spacing:{before:0,after:60}
    });
}

function bulletLine(txt){
    return new Paragraph({
        numbering:{reference:'dash',level:0},
        children:[new TextRun({text:txt,size:HS(10),font:FONT,color:C_DARK})],
        spacing:{before:0,after:20}
    });
}

function plainPara(txt,opts={}){
    return new Paragraph({
        children:[new TextRun({text:txt,size:HS(opts.size||10),font:FONT,color:opts.color||C_DARK,bold:opts.bold||false})],
        spacing:{before:opts.before||0,after:opts.after||60}
    });
}

function skillRow(l,r){
    const nb={style:BorderStyle.NONE,size:0,color:'FFFFFF'};
    const nob={top:nb,bottom:nb,left:nb,right:nb};
    const half=Math.floor(CONTENT_W/2);
    return new Table({
        width:{size:CONTENT_W,type:WidthType.DXA},
        columnWidths:[half,half],
        borders:{top:nb,bottom:nb,left:nb,right:nb,insideH:nb,insideV:nb},
        rows:[new TableRow({children:[
            new TableCell({borders:nob,width:{size:half,type:WidthType.DXA},margins:{top:0,bottom:0,left:0,right:80},children:[bulletLine(l)]}),
            new TableCell({borders:nob,width:{size:half,type:WidthType.DXA},margins:{top:0,bottom:0,left:80,right:0},children:[r?bulletLine(r):new Paragraph({children:[]})]})
        ]})]
    });
}

function masteryLabel(p){ if(p>=100)return'Native'; if(p>=80)return'Proficient'; if(p>=60)return'Intermediate'; if(p>=40)return'Basic'; return'Beginner'; }

function dateStr(sm,sy,em,ey,isCur){
    const s=[sm,sy].filter(Boolean).join(' ');
    const e=isCur?'Present':[em,ey].filter(Boolean).join(' ');
    return s&&e?`${s} \u2013 ${e}`:(s||e||'');
}

const ch=[];

// Name
ch.push(new Paragraph({
    children:[new TextRun({text:header.name||'',bold:true,size:HS(28),font:'Cambria',color:C_BLACK})],
    spacing:{before:0,after:40}
}));
// Position
if(header.position) ch.push(new Paragraph({
    children:[new TextRun({text:header.position.toUpperCase(),size:HS(9),font:FONT,color:C_MUTED,characterSpacing:40,bold:true})],
    spacing:{before:0,after:80}
}));
// Contacts
const contacts=[];
if(header.email)contacts.push(header.email);
if(header.phone)contacts.push(header.phone);
if(header.location)contacts.push(header.location);
if(header.linkedin)contacts.push(header.linkedin);
if(header.portfolio_url)contacts.push(header.portfolio_url);
if(contacts.length) ch.push(new Paragraph({
    children:contacts.map((c,i)=>[
        new TextRun({text:c,size:HS(9),font:FONT,color:C_DARK}),
        ...(i<contacts.length-1?[new TextRun({text:'  |  ',size:HS(9),font:FONT,color:C_MUTED})]:[])
    ]).flat(),
    spacing:{before:0,after:0}
}));
// Header separator
ch.push(new Paragraph({children:[],border:{bottom:{style:BorderStyle.SINGLE,size:12,color:C_LINE,space:4}},spacing:{before:120,after:0}}));

// SUMMARY
if(summary.content){ ch.push(sectionHeading('Summary')); ch.push(plainPara(summary.content,{after:80})); }

// EXPERIENCE
if(history.length){
    ch.push(sectionHeading('Experience'));
    history.forEach((job,i)=>{
        ch.push(twoColRow(job.role||'',dateStr(job.start_month,job.start_year,job.end_month,job.end_year,job.is_current)));
        ch.push(italicLine(job.company||''));
        (job.bullets||[]).forEach(b=>ch.push(bulletLine(b.content||'')));
        if(i<history.length-1)ch.push(spacer(80,0));
    });
}

// EDUCATION
if(education.length){
    ch.push(sectionHeading('Education'));
    education.forEach((edu,i)=>{
        ch.push(twoColRow(edu.degree||'',dateStr(edu.start_month,edu.start_year,edu.end_month,edu.end_year,false)));
        ch.push(italicLine(edu.school||''));
        (edu.bullets||[]).forEach(b=>ch.push(bulletLine(b.content||'')));
        if(i<education.length-1)ch.push(spacer(80,0));
    });
}

// TECHNICAL SKILLS
if(tech.length){
    ch.push(sectionHeading('Technical Skills'));
    ch.push(plainPara(tech.map(t=>t.content).join('  |  '),{after:80}));
}

// PERSONAL SKILLS
if(skills.length){
    ch.push(sectionHeading('Personal Skills'));
    for(let i=0;i<skills.length;i+=2) ch.push(skillRow(skills[i]?.content||'',skills[i+1]?.content||''));
    ch.push(spacer(60,0));
}

// LANGUAGES
if(languages.length){
    ch.push(sectionHeading('Languages'));
    ch.push(plainPara(languages.map(l=>`${l.language} (${masteryLabel(l.mastery)})`).join('     '),{after:80}));
}

// CERTIFICATIONS
if(certifications.length){
    ch.push(sectionHeading('Certifications & Achievements'));
    certifications.forEach(c=>ch.push(twoColRow(c.name||'',c.year||'',false)));
}

const doc=new Document({
    numbering:{config:[{reference:'dash',levels:[{level:0,format:LevelFormat.BULLET,text:'\u2013',alignment:AlignmentType.LEFT,style:{paragraph:{indent:{left:360,hanging:360},spacing:{before:0,after:20}},run:{font:FONT,size:HS(10),color:C_DARK}}}]}]},
    styles:{default:{document:{run:{font:FONT,size:HS(11),color:C_BLACK},paragraph:{spacing:{line:276}}}}},
    sections:[{properties:{page:{size:{width:PAGE_WIDTH,height:PAGE_HEIGHT},margin:{top:MARGIN,right:MARGIN,bottom:MARGIN,left:MARGIN}}},children:ch}]
});

const out=outputFile||'/tmp/resume_output.docx';
Packer.toBuffer(doc).then(buf=>{
    fs.writeFileSync(out,buf);
    console.log('OK:'+out+':'+buf.length);
}).catch(e=>{ console.error('ERR:'+e.message); process.exit(1); });