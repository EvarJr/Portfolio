<?php
namespace App\Controllers\Api;
use App\Models\PortfolioStackModel;

class PortfolioStackController extends BaseApiController
{
    public function index(): \CodeIgniter\HTTP\ResponseInterface
    {
        $m = new PortfolioStackModel();
        return $this->jsonSuccess($m->getAllOrdered());
    }

    public function add(): \CodeIgniter\HTTP\ResponseInterface
    {
        $d   = $this->getJson();
        $m   = new PortfolioStackModel();
        $ids = PortfolioStackModel::encodeProjects((array)($d['project_ids'] ?? []));
        $last = $m->selectMax('sort_order')->first();
        $id  = $m->insert([
            'name'        => $d['name']      ?? 'New Tech',
            'image_url'   => $d['image_url'] ?? '',
            'project_ids' => $ids,
            'sort_order'  => (int)($last['sort_order'] ?? 0) + 1,
        ]);
        return $this->jsonSuccess(['id' => $id], 'Tech added.');
    }

    public function update(int $id): \CodeIgniter\HTTP\ResponseInterface
    {
        $d = $this->getJson();
        $m = new PortfolioStackModel();
        if(!$m->find($id)) return $this->jsonError('Not found.', 404);
        $ids = PortfolioStackModel::encodeProjects((array)($d['project_ids'] ?? []));
        $m->update($id, [
            'name'        => $d['name']      ?? '',
            'image_url'   => $d['image_url'] ?? '',
            'project_ids' => $ids,
        ]);
        return $this->jsonSuccess([], 'Tech updated.');
    }

    public function delete(int $id): \CodeIgniter\HTTP\ResponseInterface
    {
        $m = new PortfolioStackModel();
        if(!$m->find($id)) return $this->jsonError('Not found.', 404);
        $m->delete($id);
        return $this->jsonSuccess([], 'Tech deleted.');
    }

    public function reorder(): \CodeIgniter\HTTP\ResponseInterface
    {
        $d = $this->getJson();
        $m = new PortfolioStackModel();
        foreach((array)($d['order'] ?? []) as $i => $id){
            $m->update((int)$id, ['sort_order' => $i + 1]);
        }
        return $this->jsonSuccess([], 'Order saved.');
    }

    public function uploadImage(int $id): \CodeIgniter\HTTP\ResponseInterface
    {
        $m = new PortfolioStackModel();
        if(!$m->find($id)) return $this->jsonError('Not found.', 404);

        $file = $this->request->getFile('image');
        if(!$file || $file->getError() !== UPLOAD_ERR_OK)
            return $this->jsonError('No file received.');

        $cloudName = env('CLOUDINARY_CLOUD_NAME');
        $apiKey    = env('CLOUDINARY_API_KEY');
        $apiSecret = env('CLOUDINARY_API_SECRET');
        $folder    = 'evarportfolio/techstack';
        $timestamp = time();
        $signature = hash('sha256', "folder={$folder}&timestamp={$timestamp}{$apiSecret}");

        $ch = curl_init("https://api.cloudinary.com/v1_1/{$cloudName}/image/upload");
        curl_setopt_array($ch, [
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST           => true,
            CURLOPT_TIMEOUT        => 60,
            CURLOPT_POSTFIELDS     => [
                'file'      => new \CURLFile($file->getTempName(), $file->getMimeType(), $file->getClientName()),
                'api_key'   => $apiKey,
                'timestamp' => $timestamp,
                'folder'    => $folder,
                'signature' => $signature,
            ],
        ]);
        $response = curl_exec($ch);
        $curlErr  = curl_error($ch);
        curl_close($ch);

        if($curlErr) return $this->jsonError('Upload failed: ' . $curlErr);
        $result = json_decode($response, true);
        if(empty($result['secure_url']))
            return $this->jsonError('Cloudinary error: ' . ($result['error']['message'] ?? 'Unknown'));

        $m->update($id, ['image_url' => $result['secure_url']]);
        return $this->jsonSuccess(['url' => $result['secure_url']], 'Image uploaded.');
    }
}