<?php

use yii\db\Migration;

/**
 * Class m210507_102028_mentor_create_task_form_input_table
 */
class m210507_102028_mentor_create_task_input_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%mentor_task_input}}', [
            'id' => $this->primaryKey(),
            'task_id' => $this->integer()->notNull(),
            'type' => $this->integer()->notNull(),
            'access_level' => $this->integer()->defaultValue(\webrise1\mentor\models\scores\TaskInput::ACCESS_LEVEL_PRIVATE),
            'name' => $this->string(),
            'title' => $this->string(),
            'description' => $this->string(),
            'default_value' => $this->text()->null(),
        ]);



        $this->addForeignKey(
            'mentor_task_input-task_id-fk',
            'mentor_task_input',
            'task_id',
            'mentor_task',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%mentor_task_input}}');
    }
}
