<?php
declare(strict_types=1);

namespace App\Controller\Api\Sample;

use App\Controller\AppController;
use Cake\Core\Configure;
use Sample\Common\Infrastructure\Cakephp\Transaction;
use Sample\Task\Application\SamplePutApplicationService;
use Sample\Task\Application\SamplePutCommand;
use Sample\Task\Infrastructure\Cakephp\SampleRepository;

class SamplePutController extends AppController
{
    /**
     * @param string $sampleId sampleId
     * @return void
     */
    public function handle(string $sampleId): void
    {
        $transaction = new Transaction();
        $sampleRepository = new SampleRepository();
        $applicationService = new SamplePutApplicationService(
            $transaction,
            $sampleRepository
        );

        $applicationService = Configure::read('Mock.SamplePutApplicationService', $applicationService);

        $data = $this->request->getData();

        $command = new SamplePutCommand(
            $sampleId,
            $data['title'],
            $data['content']
        );

        $result = $applicationService->handle($command);

        $this->set('data', []);
        $this->viewBuilder()->setOption('serialize', ['data']);
    }
}
