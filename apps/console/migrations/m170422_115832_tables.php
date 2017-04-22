<?php

use yii\db\Migration;

class m170422_115832_tables extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%category}}', [
            'id' => $this->bigPrimaryKey()->unsigned()->comment('分类 ID'),
            'parent_id' => $this->bigInteger()->unsigned()->notNull()->defaultValue(0)->comment('父级分类'),
            'name' => $this->string(60)->notNull()->comment('名称'),
            'slug' => $this->string()->unique()->comment('识别字串'),
            'child' => $this->smallInteger(1)->unsigned()->notNull()->defaultValue(0)->comment('是否有子级'),
            'parent_arr' => $this->string()->notNull()->defaultValue(0)->comment('父级链'),
            'child_arr' => $this->text()->comment('子级群'),
            'status' => $this->smallInteger(1)->unsigned()->notNull()->defaultValue(0)->comment('状态'),
        ], $tableOptions . ' COMMENT="分类"');
        $this->createIndex('category-parent', '{{%category}}', 'parent_id');
        $this->createIndex('category-status', '{{%category}}', 'status');

        $this->createTable('{{%entry}}', [
            'id' => $this->bigPrimaryKey()->unsigned()->comment('日志 ID'),
            'category_id' => $this->bigInteger()->unsigned()->notNull()->defaultValue(0)->comment('分类'),
            'user_id' => $this->bigInteger()->unsigned()->notNull()->comment('作者'),
            'name' => $this->string()->notNull()->comment('标题'),
            'slug' => $this->string()->unique()->comment('识别字串'),
            'summary' => $this->string()->notNull()->defaultValue('')->comment('概要'),
            'content' => $this->text()->notNull()->comment('正文'),
            'trackback' => $this->string()->notNull()->defaultValue('')->comment('引用'),
            'created_at' => $this->integer()->unsigned()->notNull()->defaultValue(0)->comment('创建时间'),
            'updated_at' => $this->integer()->unsigned()->notNull()->defaultValue(0)->comment('修改时间'),
            'is_short' => $this->smallInteger(1)->unsigned()->notNull()->defaultValue(0)->comment('是否短文'),
            'status' => $this->smallInteger(1)->unsigned()->notNull()->defaultValue(0)->comment('状态'),
        ], $tableOptions . ' COMMENT="日志"');
        $this->createIndex('category-entry', '{{%entry}}', 'category_id');
        $this->createIndex('user-entry', '{{%entry}}', 'user_id');
        $this->createIndex('is-short-entry', '{{%entry}}', 'is_short');
        $this->createIndex('entry-status', '{{%entry}}', 'status');

        $this->createTable('{{%attachment}}', [
            'id' => $this->bigPrimaryKey()->unsigned()->comment('附件 ID'),
            'type' => $this->smallInteger(1)->unsigned()->notNull()->defaultValue(0)->comment('类型'),
            'name' => $this->string()->notNull()->comment('名称'),
            'file' => $this->string()->notNull()->comment('文件'),
        ], $tableOptions . ' COMMENT="附件"');

        $this->createTable('{{%entry_attachment}}', [
            'entry_id' => $this->bigInteger()->unsigned()->notNull()->comment('日志'),
            'attachment_id' => $this->bigInteger()->unsigned()->notNull()->comment('附件'),
            'PRIMARY KEY (entry_id, attachment_id)',
            'FOREIGN KEY (entry_id) REFERENCES {{%entry}} (id) ON DELETE CASCADE',
            'FOREIGN KEY (attachment_id) REFERENCES {{%attachment}} (id) ON DELETE CASCADE',
        ], $tableOptions . ' COMMENT="日志附件关联"');

        $this->createTable('{{%tag}}', [
            'id' => $this->bigPrimaryKey()->unsigned()->comment('标签 ID'),
            'name' => $this->string(60)->notNull()->comment('名称'),
            'slug' => $this->string()->unique()->comment('识别字串'),
        ], $tableOptions . ' COMMENT="标签"');

        $this->createTable('{{%entry_tag}}', [
            'entry_id' => $this->bigInteger()->unsigned()->notNull()->comment('日志'),
            'tag_id' => $this->bigInteger()->unsigned()->notNull()->comment('标签'),
            'PRIMARY KEY (entry_id, tag_id)',
            'FOREIGN KEY (entry_id) REFERENCES {{%entry}} (id) ON DELETE CASCADE',
            'FOREIGN KEY (tag_id) REFERENCES {{%tag}} (id) ON DELETE CASCADE',
        ], $tableOptions . ' COMMENT="日志标签关联"');

        $this->createTable('{{%feedback}}', [
            'id' => $this->bigPrimaryKey()->unsigned()->comment('反馈 ID'),
            'user_id' => $this->bigInteger()->unsigned()->notNull()->defaultValue(0)->comment('作者'),
            'entry_id' => $this->bigInteger()->unsigned()->notNull()->comment('日志'),
            'parent_id' => $this->bigInteger()->unsigned()->notNull()->defaultValue(0)->comment('父级反馈'),
            'type' => $this->smallInteger()->unsigned()->notNull()->defaultValue(0)->comment('类型'),
            'author' => $this->string(60)->notNull()->comment('反馈人'),
            'email' => $this->string(120)->notNull()->defaultValue('')->comment('邮箱'),
            'website' => $this->string()->notNull()->defaultValue('')->comment('网址'),
            'content' => $this->text()->notNull()->comment('内容'),
            'created_at' => $this->integer()->unsigned()->notNull()->defaultValue(0)->comment('创建时间'),
            'updated_at' => $this->integer()->unsigned()->notNull()->defaultValue(0)->comment('修改时间'),
            'status' => $this->smallInteger(1)->unsigned()->notNull()->defaultValue(0)->comment('状态'),
        ], $tableOptions . ' COMMENT="反馈"');
        $this->createIndex('user-feekback', '{{%feedback}}', 'user_id');
        $this->createIndex('entry-feekback', '{{%feedback}}', 'entry_id');
        $this->createIndex('feekback-parent', '{{%feedback}}', 'parent_id');
        $this->createIndex('feekback-type', '{{%feedback}}', 'type');
        $this->createIndex('feekback-status', '{{%feedback}}', 'status');

        $this->createTable('{{%user}}', [
            'id' => $this->bigPrimaryKey()->unsigned()->comment('用户 ID'),
            'username' => $this->string(30)->notNull()->unique()->comment('用户名'),
            'auth_key' => $this->string(32)->notNull()->comment('密钥'),
            'password_hash' => $this->string()->notNull()->comment('加密密码'),
            'password_reset_token' => $this->string()->unique()->comment('密码重置 Token'),
            'email' => $this->string(60)->notNull()->unique()->comment('邮箱'),
            'created_at' => $this->integer()->unsigned()->notNull()->defaultValue(0)->comment('创建时间'),
            'updated_at' => $this->integer()->unsigned()->notNull()->defaultValue(0)->comment('修改时间'),
            'is_admin' => $this->smallInteger(1)->unsigned()->notNull()->defaultValue(0)->comment('是否管理员'),
            'status' => $this->smallInteger(1)->unsigned()->notNull()->defaultValue(0)->comment('状态'),
        ], $tableOptions . ' COMMENT="用户"');
        $this->createIndex('is-admin', '{{%user}}', 'is_admin');
        $this->createIndex('user-status', '{{%user}}', 'status');
    }

    public function down()
    {
        $this->dropTable('{{%category}}');
        $this->dropTable('{{%entry_attachment}}');
        $this->dropTable('{{%entry_tag}}');
        $this->dropTable('{{%entry}}');
        $this->dropTable('{{%attachment}}');
        $this->dropTable('{{%tag}}');
        $this->dropTable('{{%feedback}}');
        $this->dropTable('{{%user}}');
    }
}
