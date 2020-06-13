
<!--Dropdown List-->
<?= $form->field($model, 'field_name')->dropDownList(
    ArrayHelper::map(User::find()->all(),'value_select','name_select'),
    ['prompt'=>'Select User']

) ?>
