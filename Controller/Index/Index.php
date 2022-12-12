<?php

namespace Tunt\CustomLoger\Controller\Index;

use \Psr\Log\LoggerInterface;
use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\Controller\Result\JsonFactory;
use Magento\Framework\View\Result\PageFactory;

class Index extends Action
{
    /**
     * @var PageFactory
     */
    protected $resultPageFactory;

    /**
     * @var JsonFactory
     */
    protected $resultJsonFactory;

    /**
     * @var LoggerInterface
     */
    protected $logger;

    public function __construct(
        Context $context,
        PageFactory $resultPageFactory,
        JsonFactory $resultJsonFactory,
        LoggerInterface $logger
    ) {
        $this->resultPageFactory = $resultPageFactory;
        $this->resultJsonFactory = $resultJsonFactory;
        $this->logger = $logger;
        parent::__construct($context);
    }

    public function execute()
    {
        // Our logger would not allow to use debug,info and notice log types
        $this->logger->debug('Log Debug');
        $this->logger->info('Log Info');
        $this->logger->notice('Log Notice');

        // We can use below log types via our custom log
        $this->logger->warning('Log Warning');
        $this->logger->error('Log Error');
        $this->logger->critical('Log Critical');
        $this->logger->alert('Log Alert');
        $this->logger->emergency('Log Emergency');

        $result = $this->resultJsonFactory->create();
        $data = ['message' => 'Welcome'];

        return $result->setData($data);
    }
}
