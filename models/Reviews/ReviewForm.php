<?php
declare(strict_types=1);

namespace app\models\Reviews;

use yii\base\Model;

class ReviewForm extends Model
{
    public string $title = '';
    public string $text = '';

    public function rules(): array
    {
        return [
            [['title', 'text'], 'required'],
            ['title', 'string', 'length' => ['5', '150']],
            ['text', 'string', 'length' => ['10', '1000']]
        ];
    }

    function createReview(): bool
    {
        if($this->validate()) {
            $review = new Review();
            $this->saveReview($review);
            return true;
        }
        return false;
    }

    private function saveReview(Review $review): void
    {
        $request = \Yii::$app->request;
        $review->title = $this->title;
        $review->text = $this->text;
        $review->author_id = \Yii::$app->user->id;
        $review->save();
    }

}