<?php

namespace webrise1\mentor\controllers\admin;

use webrise1\mentor\models\scores\Task;
use webrise1\mentor\models\search\TaskQuestionnaireSearch;
use Yii;
use yii\web\NotFoundHttpException;

/**
 * TaskQuestionnaireController implements the CRUD actions for TaskQuestionnaire model.
 */
class TaskQuestionnaireController extends RuleController
{
    public function beforeAction($action)
    {
        if ($action->id == 'index') {
            $this->enableCsrfValidation = false;
        }

        return parent::beforeAction($action);
    }
    /**
     * Lists all TaskQuestionnaire models.
     * @param $taskId
     * @return mixed
     * @throws NotFoundHttpException
     */
    public function actionIndex($taskId)
    {
        $task = Task::findOne($taskId);
        if (!$task) {
            throw new NotFoundHttpException();
        }

//        $params = Yii::$app->request->queryParams;
//        $params['TaskQuestionnaireSearch']['task_id'] = $task->id;
        $searchModel = new  TaskQuestionnaireSearch();
        $searchModel->task_id=$taskId;
        $searchModel->select_text_input=false;
        if($get=Yii::$app->request->get())
        {
            $searchModel->filters[TaskQuestionnaireSearch::FilterByVal]=$get;
        }
        $dataProvider = $searchModel->search();
        return $this->render('/mentor/task-questionnaire/index', [
            'taskId'=>$taskId,
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Updates an existing TaskQuestionnaire model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index', 'taskId' => $model->task_id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing TaskQuestionnaire model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        $model->delete();
        return $this->redirect(['index', 'taskId' => $model->task_id]);
    }

    /**
     * Finds the TaskQuestionnaire model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return TaskQuestionnaire the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = TaskQuestionnaire::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
