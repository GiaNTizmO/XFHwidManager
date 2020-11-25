<?php

namespace hwidmanager;

use XF\AddOn\AbstractSetup;
use XF\AddOn\StepRunnerInstallTrait;
use XF\AddOn\StepRunnerUninstallTrait;
use XF\AddOn\StepRunnerUpgradeTrait;
use XF\Db\Schema\Alter;
use XF\Db\Schema\Create;

class Setup extends AbstractSetup
{
    use StepRunnerInstallTrait;
    use StepRunnerUpgradeTrait;
    use StepRunnerUninstallTrait;

    public function installStep1()
    {
        echo "   Creating xf_hwids table...";
        $this->schemaManager()->alterTable('xf_forum', function(Alter $table)
        {
            $this->schemaManager()->createTable('xf_hwid', function(Create $table)
            {
                $table->addColumn('user_id', 'int');
                $table->addColumn('hwid', 'text');
                $table->addColumn('hwid_status', 'int');
                $table->addPrimaryKey('user_id');
            });
        });
        echo "   Creating xf_hwids table... OK!";
    }

    public function installStep2()
    {
        echo "   Creating xf_bannedhwids table...";
        $this->schemaManager()->alterTable('xf_hwid', function(Alter $table)
        {
            $this->schemaManager()->createTable('xf_bannedhwids', function(Create $table)
            {
                $table->addColumn('hwid', 'text');
            });
        });
        echo "   Creating xf_bannedhwids table... OK!";
    }

    public function installStep3()
    {
        echo "   INSTALLATION DONE!";
    }
}