<?php
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

?>

<?php $form = ActiveForm::begin(); ?>

<?php
foreach ($data as $name => $variable) {
    $config = [
        'placeholder' => $variable->placeholder,
        'name' => 'Param[' . $variable->name . ']',
        'id' => 'param-' . $variable->name
    ];

    switch ($variable->type) {
        case 'string':
        case 'email':
            echo $form->field($variable, 'value')
                ->textInput($config)
                ->hint($variable->hint);
            break;

        case 'numeric':
            echo $form->field($variable, 'value')
                ->numberInput($config)
                ->hint($variable->hint);
            break;

        case 'text':
            echo $form->field($variable, 'value')
                ->textarea($config)
                ->hint($variable->hint);
            break;

        case 'select':
            echo $form->field($variable, 'value')
                ->dropDownList($variable->data, $config)
                ->hint($variable->hint);
            break;

        default:
            echo $form->field($variable, 'value')
                ->textInput($config)
                ->hint($variable->hint);
            break;
    }
}
?>
	<div class="form-group">
		<?= Html::submitButton(Yii::t('app', 'Submit'), ['class' => 'btn btn-primary', 'name' => 'contact-button']) ?>
	</div>
<?php ActiveForm::end(); ?>