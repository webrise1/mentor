<?php
namespace webrise1\mentor\controllers\api;

use webrise1\mentor\controllers\api\base\ConfigController;
use webrise1\mentor\models\scores\CompetitionQuestionnaire;
use webrise1\mentor\models\scores\Skill;
use webrise1\mentor\models\scores\SkillUserPoint;
use webrise1\mentor\models\scores\Task;
use webrise1\mentor\models\scores\TaskInputValue;
use webrise1\mentor\models\scores\Team;
use webrise1\mentor\models\search\TaskQuestionnaireSearch;
use yii\web\Controller;
use webrise1\mentor\models\scores\UserTask;
use webrise1\mentor\models\scores\TaskInput;
use yii\db\Exception;
use Yii;
class AjaxReactController extends  ConfigController {

    public function actionGetUsersRate()
    {

        if (Yii::$app->user->isGuest) {
            throw new ForbiddenHttpException('Не авторизированный пользователь');
        }
        return [
            [
                'name' => 'Рейтинг участников',
                'rangData' => UserTask::getTotalRate()
            ],
            [
                'name' => 'Задания участников',
                'taskData' => UserTask::getAllUserTasks()
            ]
        ];

    }
    public function actionGetTotalPointsBySession()
    {
        if (Yii::$app->user->isGuest) {
            throw new ForbiddenHttpException('Не авторизированный пользователь');
        }

        return [
            'name' => 'Общий балл',
            'sessions' => SkillUserPoint::getTotalPointBySession()
        ];
    }
    public function actionGetUserSkills()
    {
        if (Yii::$app->user->isGuest) {
            throw new ForbiddenHttpException('Не авторизированный пользовтель');
        }

        return Skill::getSkillsUserData();
    }
    public function actionGetTeamsRate()
    {
        if (Yii::$app->user->isGuest) {
            throw new ForbiddenHttpException('Не авторизированный пользователь');
        }

        return Team::getTotalRate();
    }
    public function actionSetCompetitionQuestionnaire()
    {

        if (Yii::$app->request->isPost) {

            $q = new CompetitionQuestionnaire();

            $q->load(Yii::$app->request->post());
            if (!Yii::$app->user->isGuest) $q->user_id = Yii::$app->user->identity->id;
            if ($q->validate()) {

                $q->save();
                return true;
            } else return $q->errors;


        }

    }
    public function actionCheckTaskQuestionnaire($taskId)
    {
        if (Yii::$app->user->isGuest) {
            throw new ForbiddenHttpException('Не авторизированный пользователь');
        }
        return TaskInputValue::find()
            ->joinWith('taskInput as ti')
            ->where(['user_id' => Yii::$app->user->id])
            ->andWhere(['ti.task_id' => $taskId])
            ->exists();
    }

    public function actionSetTaskQuestionnaire(){
            $post=Yii::$app->request->post();
            if($post){
                $task_id=$post['taskId'];
                $task=Task::findOne($task_id);
                unset($post['taskId']);
                return $task->saveTaskQuestionnaire($post);
            }
        return false;
    }


    public function actionGetTaskQuestionnare()
    {
        $post=Yii::$app->request->post();
        if(!$post)
            return false;
        $task=Task::findOne($post['taskId']);
        if(!$task)
            return false;
        $searchModel = new  TaskQuestionnaireSearch();
        $searchModel->task_id=$task->id;
        $searchModel->filters[TaskQuestionnaireSearch::FilterByAccessLevel]=[TaskInput::ACCESS_LEVEL_PUBLIC];

        if($post['filterParams'])
            $searchModel->filters[TaskQuestionnaireSearch::FilterByVal]=$post['filterParams'];

        $searchModel->makeQuery();

        return $searchModel->query->all();

    }

}