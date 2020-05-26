#Amos Report


Extension for report sending on contents like news, discussions, etc...

Installation
------------

1. The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```bash
composer require open20/amos-report
```

or add this row

```
"open20/amos-report": "dev-master"
```

to the require section of your `composer.json` file.

2. Add module to your main config in backend:
	
    ```php
    
    'modules' => [
        'comments' => [
            'class' => 'open20\amos\report\AmosReport',
            'modelsEnabled' => [
                /**
                 * Add here the classnames of the models for whose you want to enable reports
                 * (i.e. 'open20\amos\news\models\News')
                 */
            ]
        ],
    ],
    ```

3. To send report notification not only to the content creator but also to the content validator, installation of amos-workflow is needed too
 
    a. Add workflow to composer
    
    ```
    "open20/amos-workflow": "dev-master"
    ```
    
    b. check in config/main for 'workflow' in modules array, if present
    ```php
    'workflow' => [
        'class' => 'cornernote\workflow\manager\Module',
    ],
    ```
    change the entry in:
    ```php
    'workflow-manager' => [
        'class' => 'cornernote\workflow\manager\Module',
    ],
    ```
    
    c. add workflow entry (config/main in modules array):
   ```php
   'workflow' => [
       'class' => 'open20\amos\workflow\AmosWorkflow',
   ],
   ```

   d. add 'workflow' entry to your bootstrap:
	
    ```php
    'bootstrap' => [
        .
        .
        .
        'workflow',
        .
        .
        .
    ],
    ```

4. Apply migrations

    a. amos-report migrations
    ```bash
    php yii migrate/up --migrationPath=@vendor/open20/amos-report/src/migrations
    ```
    
    or add this row to your migrations config in console:
    
    ```php
    return [
        .
        .
        .
        '@vendor/open20/amos-report/src/migrations',
        .
        .
        .
    ];
    ```

    b. if workflow module is installed (see step 3), also add amos-workflow migrations:
    ```bash
    php yii migrate/up --migrationPath=@vendor/open20/amos-workflow/src/migrations
    ```
    or add this row to your migrations config in console:
    
    ```php
    return [
        .
        .
        .
        '@vendor/open20/amos-workflow/src/migrations',
        .
        .
        .
    ];
    ```

Widgets
-----------

Amos Report provides two Widgets:
* **ReportWidget** *open20\amos\report\widgets\ReportWidget*  
Draw a flag icon related to a model. On flag click, the system opens form to insert a new report on a modal popup. 

* **TabReportsWidget** *open20\amos\report\widgets\TabReportsWidget*  
Draw the Report tab in a model view/form, containing the list of reports a specif content.  
If a model has been enabled for reports, the tab is automatically injected in update phase (form) by AmosCore widget 'Tabs'.


Email Sending
-----------

After the creation of a new report on a content a mail is sent to:
 * Content creator
 * Content validator (if exixts)
 * Users having the REPORT_MONITOR role for that content type (if role exists)  
 The role name must follow the general permission naming convention <MODELNAME>_REPORT_MONITOR as for eg. create and update permissions (MODELNAME_CREATE, MODELNAME_UPDATE).
 