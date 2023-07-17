<?php
declare(strict_types=1);

namespace app\commands;

use app\models\Auth\User;
use app\models\Auth\UserRole;
use app\models\Base\BaseModel;
use app\models\Reviews\Review;
use app\models\Weather\PrecipitationType;
use app\models\Weather\Settlement;
use app\models\Weather\Weather;
use app\models\Weather\WindDirection;
use DateInterval;
use DateTime;
use Faker\Core\Number;
use Faker\Generator;
use Faker\Provider\en_US\Text;
use Yii;
use yii\console\Controller;

class SeedController extends Controller
{
    protected BaseModel $model;

    protected function saveModelAndNew(string $columnData, string $column = 'name')
    {
        $this->model->$column = $columnData;
        $this->model->save();
        $this->model = new (get_class($this->model));
    }

    public function actionIndex()
    {
        Yii::$app->db->transaction(function () {
            $this->model = new UserRole();
            $this->saveModelAndNew('user');
            $this->model = new UserRole();
            $this->model->name = 'admin';
            $this->model->save();
            $user = new User();
            $user->name = 'Jamil';
            $user->surname = 'Mamedov';
            $user->password = 'qwerty123';
            $user->email = 'mr.jam18@yandex.ru';
            $user->link('role', $this->model);
            $this->model = new Settlement();
            $this->model->author_id = $user->id;
            $this->saveModelAndNew('New york');
            $this->model->author_id = $user->id;
            $this->saveModelAndNew('Oxford');
            $this->model->author_id = $user->id;
            $this->saveModelAndNew('Denver');
            $this->model->author_id = $user->id;
            $this->saveModelAndNew('Miami');
            $this->model->author_id = $user->id;
            $this->saveModelAndNew('Las Vegas');
            $this->model->author_id = $user->id;
            $this->saveModelAndNew('Anchorage');
            $this->model->author_id = $user->id;
            $this->saveModelAndNew('Omaha');
            $this->model->author_id = $user->id;
            $this->saveModelAndNew('Portland');
            $this->model->author_id = $user->id;
            $this->saveModelAndNew('Victoria');
            $this->model->author_id = $user->id;
            $this->saveModelAndNew('Springfield');
            $this->model = new WindDirection();
            $this->saveModelAndNew('south');
            $this->saveModelAndNew('north');
            $this->saveModelAndNew('west');
            $this->saveModelAndNew('east');
            $this->saveModelAndNew('southwest');
            $this->saveModelAndNew('southeast');
            $this->saveModelAndNew('northeast');
            $this->saveModelAndNew('northwest');
            $this->model = new PrecipitationType();
            $this->saveModelAndNew('clear');
            $this->saveModelAndNew('rain');
            $this->saveModelAndNew('snow');
            $this->saveModelAndNew('rain with snow');
            $fakeNumber = new Number();
            $settlements = Settlement::find()->all();
            /**
             * @var Settlement $settlement;
             */
            foreach($settlements as $settlement) {
                $weather = new Weather();
                $now = new DateTime();
                $weather->date = $now->format(ISO_DATE_FORMAT);
                $this->weatherFactory($user, $weather, $fakeNumber, $settlement);
                $weather = new Weather();
                $weather->date = $now->sub(new DateInterval('P1D'))->format(ISO_DATE_FORMAT);
                $this->weatherFactory($user, $weather, $fakeNumber, $settlement);
            }
            $textFake = new Text(new Generator());
            for($i = 0; $i < 5; $i++) {
                $review = new Review();
                $review->title = $textFake->realText(60);
                $review->text = $textFake->realText(600);
                $review->author_id = $user->id;
                $review->save();
            }
        });
    }

    protected function weatherFactory(User $user, Weather $weather, Number $fakeNumber, Settlement $settlement): void
    {
        $weather->author_id = $user->id;
        $weather->min_air_temperature = $fakeNumber->numberBetween(-50, 50);
        $weather->max_air_temperature = $fakeNumber->numberBetween($weather->min_air_temperature, 50);
        $weather->wind_speed = $fakeNumber->numberBetween(0, 40);
        $weather->rainfall = $fakeNumber->numberBetween(0, 30);
        $weather->settlement_id = $settlement->id;
        $weather->wind_direction_id = $fakeNumber->numberBetween(1, 8);
        $weather->precipitation_type_id = $fakeNumber->numberBetween(1, 4);
        $weather->save();
    }

}