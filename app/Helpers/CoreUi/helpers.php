<?php

use App\Helpers\coreui\CoreUIFacades;

if(!function_exists('cui')){
    function cui(){
        return app()->get('cui');
    }
}

function cui_toolbar_btn_delete($url, $id, $icon, $text = null, $message = 'Anda yakin?')
{
    $str = Form::open([
        'style' => 'display: inline-block;',
        'method' => 'DELETE',
        'id' => 'delete-form-toolbar',
        'url' => $url]);
    $str .= Form::hidden('id', $id);
    $str .= Form::close();

    return $str.'<button class="btn" href="'.$url.'" onclick="if(confirm(\''.$message.'\')){ document.getElementById(\'delete-form-toolbar\').submit(); }"> <i class="'.$icon.'"></i> &nbsp;'.$text.'</button>';
}

function cui_toolbar_btn($url, $icon, $text = null)
{
    return '<a class="c-header-nav-link" href="' . $url . '"> <i class="' . $icon . '"></i> &nbsp;' . $text . '</a>';
}

function cui_breadcrumb($levels)
{
    $results = '';
    $n = count($levels);
    $i = 1;
    foreach ($levels as $menu => $url)
    {
        if($i == $n){
            $results .= '<li class="breadcrumb-item active">' . $menu . '</li>';
        }else {
            $results .= '<li class="breadcrumb-item"><a href="' . $url . '">' . $menu . '</a></li>';
        }
        $i++;
    }
    return $results;
}

function cui_btn($url, $icon, $text=""){
    return "<a href='$url' class='btn btn-sm btn-outline-info'><i class='fa $icon'></i>$text</a>";
}

function cui_btn_view($url, $text = "")
{
    return "<a href='$url' class='btn btn-sm btn-outline-info'><i class='fa fa-eye'>$text</i></a>";
}


function cui_btn_edit($url, $text = "")
{
    return "<a href='$url' class='btn btn-sm btn-outline-info'><i class='fa fa-pencil'>$text</i></a>";
}

function cui_btn_active($model, $url, $text=""){
    $str = Form::model($model, array(
        'style' => 'display: inline-block;',
        'method' => 'PUT',
        'url' => $url));
    $str .= Form::hidden('status', 1);
    $str .= Form::button($text, ['class' => 'btn btn-sm btn-success', 'type' => 'submit']);
    $str .= Form::close();

    return $str;
}

function cui_btn_deactive($model, $url, $text=""){
    $str = Form::model($model, array(
        'style' => 'display: inline-block;',
        'method' => 'PUT',
        'url' => $url));
    $str .= Form::hidden('status', 2);
    $str .= Form::button($text, ['class' => 'btn btn-sm btn-danger', 'type' => 'submit']);
    $str .= Form::close();

    return $str;
}

function cui_btn_delete($url, $message, $text = "")
{
    $str = Form::open(array(
        'style' => 'display: inline-block;',
        'method' => 'DELETE',
        'onsubmit' => "return confirm('$message');",
        'url' => $url));
    $str .= Form::button('<i class="fa fa-trash"></i>'.$text, ['class' => 'btn btn-sm btn-outline-danger', 'type' => 'submit']);
    $str .= Form::close();

    return $str;
}
