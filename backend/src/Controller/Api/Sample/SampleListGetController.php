<?php
declare(strict_types=1);

namespace App\Controller\Api\Sample;

use App\Controller\AppController;
use Cake\Core\Configure;
use Sample\Task\Application\SampleListGetApplicationService;
use Sample\Task\Application\SampleListGetCommand;
use Sample\Task\Infrastructure\Cakephp\SampleRepository;

class SampleListGetController extends AppController
{
    /**
     * @return void
     */
    public function handle(): void
    {
        $sampleRepository = new SampleRepository();
        $applicationService = new SampleListGetApplicationService(
            $sampleRepository
        );

        $applicationService = Configure::read('Mock.SampleListGetApplicationService', $applicationService);

        $command = new SampleListGetCommand();

        $result = $applicationService->handle($command);

        $data = [];
        foreach ($result->samples as $sample) {
            $data[] = [
                'sample_id' => $sample->sampleId,
                'title' => $sample->title,
                'content' => $sample->content,
            ];
        }

        $this->set('data', $data);
        $this->viewBuilder()->setOption('serialize', ['data']);
    }
}
