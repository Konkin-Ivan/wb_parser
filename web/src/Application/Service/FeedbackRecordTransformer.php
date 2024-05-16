<?php

namespace App\Application\Service;

use App\Domain\Entity\FeedbackRecord;

class FeedbackRecordTransformer
{
    public function transformFeedbackRecords(array $feedbackRecords): array
    {
        $data = [];
        foreach ($feedbackRecords as $record) {
            $data[] = $this->transformFeedbackRecord($record);
        }

        return $data;
    }

    public function transformFeedbackRecord(FeedbackRecord $record): array
    {
        return [
            'id' => $record->getId(),
            'feedback_count' => $record->getFeedbackCount(),
            'recordDate' => $record->getRecordDate()->format('Y-m-d'),
            // ... other fields
        ];
    }
}