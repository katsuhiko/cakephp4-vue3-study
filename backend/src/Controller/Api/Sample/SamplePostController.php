<?php
declare(strict_types=1);

namespace App\Controller\Api\Sample;

use App\Controller\AppController;
use Cake\Core\Configure;
use Sample\Common\Infrastructure\Cakephp\Transaction;
use Sample\Task\Application\SamplePostApplicationService;
use Sample\Task\Application\SamplePostCommand;
use Sample\Task\Infrastructure\Cakephp\SampleRepository;

class SamplePostController extends AppController
{
    /**
     * @return void
     */
    public function handle(): void
    {
        $transaction = new Transaction();
        $sampleRepository = new SampleRepository();
        $applicationService = new SamplePostApplicationService(
            $transaction,
            $sampleRepository
        );

        $applicationService = Configure::read('Mock.SamplePostApplicationService', $applicationService);

        $data = $this->request->getData();

        $command = new SamplePostCommand(
            $data['title'],
            $data['content']
        );

        $result = $applicationService->handle($command);

        $this->set('data', [
            'sample_id' => $result->sampleId,
        ]);
        $this->viewBuilder()->setOption('serialize', ['data']);
    }
}
