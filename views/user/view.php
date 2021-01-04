<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\User */
/* @var $contests array */
/* @var $contestCnt integer */

$this->title = $model->nickname;
$solutionStats = $model->getSolutionStats();
$recentSubmission = $model->getRecentSubmission();
?>

<h3><?= Html::encode($model->getColorName()) ?></h3>
<p></p>
<?php if ($model->role != \app\models\User::ROLE_PLAYER): ?>
<div class="row">
    <div class="col-lg-4">

        <?php
        // $hash = md5(strtolower(trim($model->email)));
        // $uri = 'https://cdn.v2ex.com/gravatar/' . $hash . '?&s=512&d=mm';
        // $headers = @get_headers($uri);
        // if (preg_match("|200|", $headers[0])) {
        //     echo '<div class="d-none d-md-block"><img class="img-fluid rounded img-thumbnail" onerror="errorImg(this)" src="'. $uri .'"><p></p></div>';
        // }
        ?>
        <div class="list-group">
            <div class="list-group-item">
                <?= Yii::t('app', 'Username') ?><span
                    class="float-right text-secondary"><?= Html::encode($model->username)?></span>
            </div>
            <div class="list-group-item">
                <?= Yii::t('app', 'Major') ?><span
                    class="float-right text-secondary"><?= Html::encode($model->profile->major)?></span>
            </div>
            <div class="list-group-item">
                <?=  Yii::t('app', 'Student Number') ?><span
                    class="float-right text-secondary"><?= $model->profile->student_number?></span>
            </div>
            <div class="list-group-item">
                积分<span class="float-right text-secondary"><?= isset($model->rating)?$model->rating:'Unrated'?></span>
            </div>
        </div>
        <p></p>
        <div class="list-group">
            <div class="list-group-item">
                提交总数<span class="float-right text-secondary"> <?= $solutionStats['all_count'] ?></span>
            </div>
            <div class="list-group-item">
                通过<span class="float-right text-secondary"> <?= $solutionStats['ac_count'] ?></span>
            </div>
            <div class="list-group-item">
                通过率
                <span class="float-right text-secondary">
                    <?= $solutionStats['all_count'] == 0 ? 0 : number_format($solutionStats['ac_count'] / $solutionStats['all_count'] * 100, 2) ?>%
                </span>
            </div>
            <div class="list-group-item">
                错误解答<span class="float-right text-secondary"> <?= $solutionStats['wa_count'] ?></span>
            </div>
            <div class="list-group-item">
                时间超限<span class="float-right text-secondary"> <?= $solutionStats['tle_count'] ?></span>
            </div>
            <div class="list-group-item">
                编译错误<span class="float-right text-secondary"> <?= $solutionStats['ce_count'] ?></span>
            </div>
        </div>
        <p></p>
    </div>
    <div class="col-lg-8">

        <div class="card">
            <!-- <div class="card-header">个人档案</div> -->
            <div class="card-body">
                <?php if($model->profile->personal_intro != ''):?>
                <?= Yii::$app->formatter->asMarkdown($model->profile->personal_intro) ?>
                <?php else:?>
                没有找到数据。
                <?php endif;?>
            </div>
        </div>
        <p></p>

        <div class="card">
            <div class="card-header">已解答 <small class="text-secondary"><?= count($solutionStats['solved_problem']) ?>
                    Problem<?php if(count($solutionStats['solved_problem'])!=1) echo"s"; ?></small></div>
            <div class="card-body">
                <?php if(count($solutionStats['solved_problem']) != 0):?>
                <?php foreach ($solutionStats['solved_problem'] as $p): ?>
                <?= Html::a('<code>' . $p . '</code>', ['/problem/view', 'id' => $p], ['class' => 'btn-sm bg-light text-dark', 'style' => "margin-bottom:0.5rem"]) ?>
                <?php endforeach; ?>
                <?php else:?>
                没有找到数据。
                <?php endif;?>
            </div>
        </div>
        <p></p>


        <div class="card">
            <div class="card-header">未解答 <small class="text-secondary"><?= count($solutionStats['unsolved_problem']) ?>
                    Problem<?php if(count($solutionStats['unsolved_problem'])!=1) echo"s"; ?></small></div>
            <div class="card-body">
                <?php if(count($solutionStats['unsolved_problem']) != 0):?>
                <?php foreach ($solutionStats['unsolved_problem'] as $p): ?>
                <?= Html::a('<code>' . $p . '</code>', ['/problem/view', 'id' => $p], ['class' => 'btn-sm bg-light text-dark', 'style' => "margin-bottom:0.5rem"]) ?>
                <?php endforeach; ?>
                <?php else:?>
                没有找到数据。
                <?php endif;?>
            </div>
        </div>
        <p></p>
    </div>

</div>


<?php else: ?>
<div class="card">
    <div class="card-body">
        线下赛参赛账户。 </div>
</div>
<?php endif; ?>