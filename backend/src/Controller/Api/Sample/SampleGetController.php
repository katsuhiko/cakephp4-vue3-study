<?php
declare(strict_types=1);

namespace App\Controller\Api\Sample;

use App\Controller\AppController;
use Cake\Core\Configure;
use Sample\Task\Application\SampleGetApplicationService;
use Sample\Task\Application\SampleGetCommand;
use Sample\Task\Infrastructure\Cakephp\SampleRepository;

class SampleGetController extends AppController
{
    /**
     * @param string $sampleId sampleId
     * @return void
     */
    public function handle(string $sampleId): void
    {
        $sampleRepository = new SampleRepository();
        $applicationService = new SampleGetApplicationService(
            $sampleRepository
        );

        $applicationService = Configure::read('Mock.SampleGetApplicationService', $applicationService);

        $command = new SampleGetCommand(
            $sampleId
        );

        $result = $applicationService->handle($command);

        $this->set('data', [
            'sample_id' => $result->sampleId,
            'title' => $result->title,
            'content' => $result->content,
        ]);
        $this->viewBuilder()->setOption('serialize', ['data']);
    }
}
