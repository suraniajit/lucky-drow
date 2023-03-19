<?php

use Illuminate\Support\HtmlString;
use Illuminate\Support\ViewErrorBag;

/*
|--------------------------------------------------------------------------
| Standard fields
|--------------------------------------------------------------------------
*/
/*
 * Add an input field
 *
 * @param string $name The field name
 * @param string $title The field title
 * @param object $errors The laravel errors object
 * @param null|object $object The entity of the field
 *
 * @return HtmlString
 */

Form::macro('normalText', function ($name, $title, ViewErrorBag $errors, $value = null, array $options = []) {
    $errorField = cleanFieldName($name);
    $labelTitle = trans($title);
    $options = array_merge(['class' => 'form-control', 'placeholder' => $labelTitle, 'hide_label' => false], $options);
    $maxLength = config("core.varchar_maxlength");
    $options['maxlength'] = (isset($options['maxlength'])) ? $options['maxlength'] : $maxLength;
    $errorClass = "";
    if ($errors->has($errorField)) {
        $options['class'] = $options['class'] . " is-invalid";
        $errorClass = "error";
    }
    $string = '<div class="form-group">';
    if (!$options['hide_label']) {
        $string .= Form::label($errorField, $labelTitle, ["class" => $errorClass]);
        if (strpos($options['class'], 'required') || isset($options['required'])) {
            $string .= '<span class="' . $errorClass . '"> *</span>';
        }
    }

    $string .= Form::text($name, old($errorField, $value), $options);
    if (isset($options['append']) && $options['append']) {
        $string .= $options['append'];
    }

    $string .= $errors->first($errorField, '<label id="' . $errorField . '-error" class="error" for="' . $errorField . '">:message</label>');

    $string .= '</div>';
    return new HtmlString($string);
});

/*
 * Add an input field of specified type
 *
 * @param string $type The type of field
 * @param string $name The field name
 * @param string $title The field title
 * @param object $errors The laravel errors object
 * @param null|object $object The entity of the field
 *
 * @return HtmlString
 */

Form::macro('normalInputOfType', function ($type, $name, $title, ViewErrorBag $errors, $value = null, array $options = []) {
    $errorField = cleanFieldName($name);
    $labelTitle = trans($title);
    $options = array_merge(['class' => 'form-control', 'placeholder' => $labelTitle, 'hide_label' => false], $options);
    $maxLength = config("core.smallint_maxlength");
    $options['maxlength'] = (isset($options['maxlength'])) ? $options['maxlength'] : $maxLength;
    $errorClass = "";
    if ($errors->has($errorField)) {
        $options['class'] = $options['class'] . " is-invalid";
        $errorClass = "error";
    }

    $string = '<div class="form-group">';
    if (!$options['hide_label']) {
        $string .= Form::label($errorField, $labelTitle, ["class" => $errorClass]);
        if (strpos($options['class'], 'required') || isset($options['required'])) {
            $string .= '<span class="' . $errorClass . '"> *</span>';
        }
    }

    $string .= Form::input($type, $name, old($errorField, $value), $options);
    if (isset($options['append']) && $options['append']) {
        $string .= $options['append'];
    }

    $string .= $errors->first($errorField, '<label id="' . $errorField . '-error" class="error" for="' . $errorField . '">:message</label>');
    $string .= '</div>';
    return new HtmlString($string);
});

/*
 * Add a textarea field
 *
 * @param string $name
 * @param string $title
 * @param ViewErrorBag $errors
 * @param null|object $object
 * @param array $options
 *
 * @return HtmlString
 */
Form::macro('normalTextarea', function ($name, $title, ViewErrorBag $errors, $value = null, array $options = []) {
    $errorField = cleanFieldName($name);
    $labelTitle = trans($title);
    $options = array_merge(['class' => 'form-control', 'placeholder' => $labelTitle, 'hide_label' => false], $options);

    $errorClass = "";
    if ($errors->has($errorField)) {
        $options['class'] = $options['class'] . " is-invalid";
        $errorClass = "error";
    }

    $string = "<div class='form-group'>";
    if (!$options['hide_label']) {
        $string .= Form::label($errorField, $labelTitle);
        if (strpos($options['class'], 'required') || isset($options['required'])) {
            $string .= '<span class="' . $errorClass . '"> *</span>';
        }
    }

    $string .= Form::textarea($name, old($errorField, $value), $options);
    $string .= $errors->first($errorField, '<label id="' . $errorField . '-error" class="error" for="' . $errorField . '">:message</label>');
    $string .= '</div>';
    return $string;
});


/*
 * Add a textarea field
 *
 * @param string $name
 * @param string $title
 * @param ViewErrorBag $errors
 * @param null|object $object
 * @param array $options
 *
 * @return HtmlString
 */
Form::macro('FormatedTextarea', function ($name, $title, ViewErrorBag $errors, $value = null, array $options = []) {
    $errorField = cleanFieldName($name);
    $labelTitle = trans($title);
    $options = array_merge(['class' => 'form-control', 'placeholder' => $labelTitle, 'hide_label' => false], $options);

    $errorClass = "";
    if ($errors->has($errorField)) {
        $options['class'] = $options['class'] . " is-invalid";
        $errorClass = "error";
    }

    $string = "<div class='form-group'>";
    if (!$options['hide_label']) {
        $string .= Form::label($errorField, $labelTitle);
        if (strpos($options['class'], 'required') || isset($options['required'])) {
            $string .= '<span class="' . $errorClass . '"> *</span>';
        }
    }

    $string .= Form::textarea($name, old($errorField, $value), $options);
    $string .= $errors->first($errorField, '<label id="' . $errorField . '-error" class="error" for="' . $errorField . '">:message</label>');
    $string .= '</div>';
    return $string;
});

/*
 * Add a checkbox input field
 *
 * @param string $name The field name
 * @param string $title The field title
 * @param object $errors The laravel errors object
 * @param null|object $object The entity of the field
 *
 * @return HtmlString
 */
Form::macro('normalCheckbox', function ($name, $title, ViewErrorBag $errors, $value = null, $options = []) {
    $errorField = cleanFieldName($name);
    $labelTitle = trans($title);
    $class = " custom-control-input " . ($errors->has($errorField) ? ' is-invalid' : '') . "";
    $options = array_merge(['class' => 'custom-control-input', 'placeholder' => $labelTitle], $options);
    $options['class'] .= $class;

    $options['id'] = $errorField;
    $string = "<div class='custom-control custom-checkbox'>";

    $currentData = isset($value) && (bool)$value ? 'checked' : false;
    $string .= Form::checkbox($name, $value, $currentData, $options);

    $string .= "<label class='custom-control-label' for='$errorField'>";
    $string .= $labelTitle;
    if (strpos($options['class'], 'required') || isset($options['required'])) {
        $string .= '<span class="error">*</span>';
    }
    $string .= $errors->first($errorField, '<label id="' . $errorField . '-error" class="error" for="' . $errorField . '">:message</label>');
    $string .= '</label>';
    $string .= '</div>';

    return new HtmlString($string);
});

/*
 * Add a dropdown select field
 *
 * @param string $name The field name
 * @param string $title The field title
 * @param object $errors The laravel errors object
 * @param array $choice The choice of the select
 * @param null|array $object The entity of the field
 *
 * @return HtmlString
 */
Form::macro('normalSelect', function ($name, $title, ViewErrorBag $errors, array $choice, $value = null, array $options = []) {
    $errorField = cleanFieldName($name);
    if (array_key_exists('multiple', $options)) {
        $nameForm = $name . '[]';
    } else {
        $nameForm = $name;
    }

    $labelTitle = trans($title);
    $options = array_merge(['class' => 'custom-select', 'hide_label' => false], $options);

    $errorClass = "";
    if ($errors->has($errorField)) {
        $options['class'] = $options['class'] . " is-invalid";
        $errorClass = "error";
    }

    $string = '<div class="form-group">';
    if (!$options['hide_label']) {
        $string .= Form::label($errorField, $labelTitle);
        if (strpos($options['class'], 'required') || isset($options['required'])) {
            $string .= '<span class="' . $errorClass . '"> *</span>';
        }
    }
    unset($options['hide_label']);
    $string .= Form::select($name, $choice, old($errorField, $value), $options);
    $string .= $errors->first($errorField, '<label id="' . $errorField . '-error" class="error" for="' . $errorField . '">:message</label>');
    $string .= '</div>';
    return new HtmlString($string);
});

/*
 * Add a translatable input field
 *
 * @param string $name The field name
 * @param string $title The field title
 * @param object $errors The laravel errors object
 * @param string $lang the language of the field
 * @param null|object $object The entity of the field
 *
 * @return HtmlString
 */
Form::macro('i18nInput', function ($name, $title, ViewErrorBag $errors, $lang, $object = null, array $options = []) {

    $options = array_merge(['class' => 'form-control', 'placeholder' => $title, 'hide_label' => false], $options);
    $maxLength = config("core.varchar_maxlength");
    $options['maxlength'] = (isset($options['maxlength'])) ? $options['maxlength'] : $maxLength;
    $errorClass = ' has-error';
    $string = "<div class='form-group " . ($errors->has($lang . '.' . $name) ? ' has-error' : '') . "'>";
    $string .= Form::label("{$lang}[{$name}]", $title);

    if (!$options['hide_label']) {
        if (strpos($options['class'], 'required') || isset($options['required'])) {
            $string .= '<span class="' . $errorClass . '"> *</span>';
        }
    }
    if (is_object($object)) {
        $currentData = $object->hasTranslation($lang) ? $object->translate($lang)->{$name} : '';
    } else {
        $currentData = '';
    }

    $string .= Form::text("{$lang}[{$name}]", old("{$lang}[{$name}]", $currentData), $options);
    $string .= $errors->first("{$lang}.{$name}", '<label class="error">:message</label>');
    $string .= '</div>';

    return new HtmlString($string);
});


Form::macro('i18nInputarray', function ($name, $title, ViewErrorBag $errors, $lang, $object = null, array $options = []) {

    $options = array_merge(['class' => 'form-control', 'placeholder' => $title, 'hide_label' => false], $options);
    $maxLength = config("core.varchar_maxlength");
    $options['maxlength'] = (isset($options['maxlength'])) ? $options['maxlength'] : $maxLength;
    $errorClass = ' has-error';
    $string = "<div class='form-group " . ($errors->has($lang . '.' . $name) ? ' has-error' : '') . "'>";
    $string .= Form::label("{$lang}{$name}", $title);

    if (!$options['hide_label']) {
        if (strpos($options['class'], 'required') || isset($options['required'])) {
            $string .= '<span class="' . $errorClass . '"> *</span>';
        }
    }
    if (is_object($object)) {
        $currentData = $object->hasTranslation($lang) ? $object->translate($lang)->{$name} : '';
    } else {
        $currentData = '';
    }

    $string .= Form::text("{$lang}$name", old("{$lang}{$name}", $currentData), $options);
    $string .= $errors->first("{$lang}.{$name}", '<label class="error">:message</label>');
    $string .= '</div>';

    return new HtmlString($string);
});
/*
 * Add a translatable input field of specified type
 *
 * @param string $type The type of field
 * @param string $name The field name
 * @param string $title The field title
 * @param object $errors The laravel errors object
 * @param string $lang the language of the field
 * @param null|object $object The entity of the field
 *
 * @return HtmlString
 */
Form::macro('i18nInputOfType', function ($type, $name, $title, ViewErrorBag $errors, $lang, $object = null, array $options = []) {
    $options = array_merge(['class' => 'form-control', 'placeholder' => $title, 'hide_label' => false], $options);
    $maxLength = config("core.smallint_maxlength");
    $options['maxlength'] = (isset($options['maxlength'])) ? $options['maxlength'] : $maxLength;
    $errorClass = ' has-error';
    $string = "<div class='form-group " . ($errors->has($lang . '.' . $name) ? ' has-error' : '') . "'>";
    $string .= Form::label("{$lang}[{$name}]", $title);

    if (!$options['hide_label']) {
        if (strpos($options['class'], 'required') || isset($options['required'])) {
            $string .= '<span class="' . $errorClass . '"> *</span>';
        }
    }

    if (is_object($object)) {
        $currentData = $object->hasTranslation($lang) ? $object->translate($lang)->{$name} : '';
    } else {
        $currentData = '';
    }

    $string .= Form::input($type, "{$lang}[{$name}]", old("{$lang}[{$name}]", $currentData), $options);
    $string .= $errors->first("{$lang}.{$name}", '<label class="error">:message</label>');
    $string .= '</div>';

    return new HtmlString($string);
});

/*
 * Add a translatable textarea field
 *
 * @param string $name The field name
 * @param string $title The field title
 * @param object $errors The laravel errors object
 * @param string $lang the language of the field
 * @param null|object $object The entity of the field
 *
 * @return HtmlString
 */
Form::macro('i18nTextarea', function ($name, $title, ViewErrorBag $errors, $lang, $object = null, array $options = []) {
    $options = array_merge(['class' => 'ckeditor', 'rows' => 10, 'cols' => 10, 'hide_label' => false], $options);

    $errorClass = ' has-error';
    $string = "<div class='form-group " . ($errors->has($lang . '.' . $name) ? ' has-error' : '') . "'>";
    $string .= Form::label("{$lang}[{$name}]", $title);

    if (!$options['hide_label']) {
        if (strpos($options['class'], 'required') || isset($options['required'])) {
            $string .= '<span class="' . $errorClass . '"> *</span>';
        }
    }

    if (is_object($object)) {
        $currentData = $object->hasTranslation($lang) ? $object->translate($lang)->{$name} : '';
    } else {
        $currentData = '';
    }

    $string .= Form::textarea("{$lang}[$name]", old("{$lang}[{$name}]", $currentData), $options);
    $string .= $errors->first("{$lang}.{$name}", '<label class="error">:message</label>');
    $string .= '</div>';

    return $string;
});

/*
 * Add a translatable checkbox input field
 *
 * @param string $name The field name
 * @param string $title The field title
 * @param object $errors The laravel errors object
 * @param string $lang the language of the field
 * @param null|object $object The entity of the field
 *
 * @return HtmlString
 */
Form::macro('i18nCheckbox', function ($name, $title, ViewErrorBag $errors, $lang, $object = null) {
    $string = "<div class='checkbox" . ($errors->has($lang . '.' . $name) ? ' has-error' : '') . "'>";
    $string .= "<label for='{$lang}[{$name}]'>";
    $string .= "<input id='{$lang}[{$name}]' name='{$lang}[{$name}]' type='checkbox' class='flat-blue'";

    if (is_object($object)) {
        $currentData = $object->hasTranslation($lang) ? (bool)$object->translate($lang)->{$name} : '';
    } else {
        $currentData = false;
    }

    $oldInput = old("{$lang}.$name", $currentData) ? 'checked' : '';
    $string .= "value='1' {$oldInput}>";
    $string .= $title;
    $string .= $errors->first($name, '<label class="error">:message</label>');
    $string .= '</label>';
    $string .= '</div>';

    return new HtmlString($string);
});

/*
 * Add a translatable dropdown select field
 *
 * @param string $name The field name
 * @param string $title The field title
 * @param object $errors The laravel errors object
 * @param string $lang the language of the field
 * @param array $choice The choice of the select
 * @param null|array $object The entity of the field
 *
 * @return HtmlString
 */
Form::macro('i18nSelect', function ($name, $title, ViewErrorBag $errors, $lang, array $choice, $object = null, array $options = []) {
    if (array_key_exists('multiple', $options)) {
        $nameForm = "{$lang}[$name][]";
    } else {
        $nameForm = "{$lang}[$name]";
    }

    $string = "<div class='form-group dropdown" . ($errors->has($lang . '.' . $name) ? ' has-error' : '') . "'>";
    $string .= "<label for='$nameForm'>$title</label>";

    if (is_object($object)) {
        $currentData = $object->hasTranslation($lang) ? $object->translate($lang)->{$name} : '';
    } else {
        $currentData = false;
    }

    /* Bootstrap default class */
    $array_option = ['class' => 'form-control'];

    if (array_key_exists('class', $options)) {
        $array_option = ['class' => $array_option['class'] . ' ' . $options['class']];
        unset($options['class']);
    }

    $options = array_merge($array_option, $options);

    $string .= Form::select($nameForm, $choice, old($nameForm, $currentData), $options);
    $string .= $errors->first("{$lang}.{$name}", '<label class="error">:message</label>');
    $string .= '</div>';

    return new HtmlString($string);
});

Form::macro('i18nFile', function ($name, $title, ViewErrorBag $errors, $lang, $object = null, array $options = []) {
    if (array_key_exists('multiple', $options)) {
        $nameForm = "{$lang}[$name][]";
    } else {
        $nameForm = "{$lang}[$name]";
    }

    $options = array_merge(['class' => 'form-control'], $options);

    $string = "<div class='form-group " . ($errors->has($lang . '.' . $name) ? ' has-error' : '') . "'>";
    $string .= "<label for='$nameForm'>$title</label>";

    if (is_object($object)) {
        $currentData = $object->hasTranslation($lang) ? $object->translate($lang)->{$name} : '';
    } else {
        $currentData = false;
    }

    $string .= Form::file("{$lang}[{$name}]", $options);

    $string .= $errors->first("{$lang}.{$name}", '<label class="error">:message</label>');
    $string .= '</div>';

    return new HtmlString($string);
});

//Custom macros for form without label
Form::macro('i18nInputAttribute', function ($name, $variable, $title, ViewErrorBag $errors, $lang, $object = null, array $options = []) {

    $options = array_merge(['class' => 'form-control', 'placeholder' => $title, 'hide_label' => false], $options);

    $errorClass = ' has-error';
    $string = '<div class="form-group ' . ($errors->has($lang . '.' . $name) ? ' has-error' : '') . '">';
    // $string .= Form::label("{$lang}[{$name}]", $title);

    if (!$options['hide_label']) {
        if (strpos($options['class'], 'required') || isset($options['required'])) {
            $string .= '<span class="' . $errorClass . '"> *</span>';
        }
    }
    if (is_object($object)) {
        $currentData = $object->hasTranslation($lang) ? $object->translate($lang)->{$name} : '';
    } else {
        $currentData = '';
    }

    $string .= Form::text("{$variable}[{$lang}][{$name}]", old("{$variable}[{$lang}][{$name}]", $currentData), $options);
    $string .= $errors->first("{$lang}.{$name}", '<label class="error">:message</label>');
    $string .= '</div>';

    return new HtmlString($string);
});

Form::macro('i18nInputWithName', function ($name, $variable, $title, ViewErrorBag $errors, $lang, $object = null, array $options = []) {

    $options = array_merge(['class' => 'form-control', 'placeholder' => $title, 'hide_label' => false], $options);

    $errorClass = ' has-error';
    $string = '<div class="form-group ' . ($errors->has($lang . '.' . $name) ? ' has-error' : '') . '">';
    $string .= Form::label("{$lang}[{$name}]", $title);

    if (!$options['hide_label']) {
        if (strpos($options['class'], 'required') || isset($options['required'])) {
            $string .= '<span class="' . $errorClass . '"> *</span>';
        }
    }
    if (is_object($object)) {
        $currentData = $object->hasTranslation($lang) ? $object->translate($lang)->{$name} : '';
    } else {
        $currentData = '';
    }

    $string .= Form::text("{$variable}[{$lang}][{$name}]", old("{$variable}[{$lang}][{$name}]", $currentData), $options);
    $string .= $errors->first("{$lang}.{$name}", '<label class="error">:message</label>');
    $string .= '</div>';

    return new HtmlString($string);
});

Form::macro('i18nTextareaWithName', function ($name, $variable, $title, ViewErrorBag $errors, $lang, $object = null, array $options = []) {
    $options = array_merge(['class' => 'ckeditor', 'rows' => 10, 'cols' => 10, 'hide_label' => false], $options);

    $errorClass = ' has-error';
    $string = "<div class='form-group " . ($errors->has($lang . '.' . $name) ? ' has-error' : '') . "'>";
    $string .= Form::label("{$lang}[{$name}]", $title);

    if (!$options['hide_label']) {
        if (strpos($options['class'], 'required') || isset($options['required'])) {
            $string .= '<span class="' . $errorClass . '"> *</span>';
        }
    }

    if (is_object($object)) {
        $currentData = $object->hasTranslation($lang) ? $object->translate($lang)->{$name} : '';
    } else {
        $currentData = '';
    }
    $string .= Form::textarea("{$variable}[{$lang}][$name]", old("{$variable}[{$lang}][{$name}]", $currentData), $options);
    $string .= $errors->first("{$lang}.{$name}", '<label class="error">:message</label>');
    $string .= '</div>';

    return $string;
});
//End with custom macros
if (!function_exists("cleanFieldName")) {

    function cleanFieldName($name)
    {
        return str_replace(array('[', ']'), array(".", ""), $name);
    }
}
