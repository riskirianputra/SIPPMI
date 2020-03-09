<?php


namespace App\Helpers\CoreUi;

class Cui
{
    public function __construct()
    {
    }

    public static function toolbar_delete($url, $id, $icon, $text = null, $message = 'Anda yakin?')
    {
        $str = '<form action="'.$url.'" style="display:none" method="POST" id= "delete-form-toolbar" onsubmit="return confirm(\''.$message.'\');">';
        $str .= '<input type="hidden" name="_method" value="DELETE" />';
        $str .= '<input type="hidden" name="_token" value="'.csrf_token().'" />';
        $str .= '<input type="hidden" name="id" value="'.$id.'" />';
        $str .= '<button type="submit" class="btn btn-sm btn-outline-danger"><i class="fa fa-trash"></i> '.$text.'</button>';
        $str .= '</form>';

        return $str.'<button class="btn" href="'.$url.'" onclick="if(confirm(\''.$message.'\')){ document.getElementById(\'delete-form-toolbar\').submit(); }"> <i class="'.$icon.'"></i> &nbsp;'.$text.'</button>';
    }

    public static function toolbar_btn($url, $icon, $text = null)
    {
        return '<a class="c-header-nav-link" href="'.$url.'"> <span class="c-icon"><i class="'.$icon.'"></i></span> &nbsp;'.$text.'</a>';
    }

    public static function breadcrumb($levels)
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

    public static function btn($url, $icon, $text=""){
        return "<a href='$url' class='btn btn-sm btn-outline-info'><i class='fa $icon'></i>$text</a>";
    }

    public static function btn_view($url, $text = "")
    {
        return "<a href='$url' class='btn btn-sm btn-outline-info'><i class='fa fa-eye'>$text</i></a>";
    }

    public static function btn_edit($url, $text = "")
    {
        return "<a href='$url' class='btn btn-sm btn-outline-info'><i class='fa fa-pencil'>$text</i></a>";
    }

    public static function btn_delete($url, $message, $text = "")
    {
        $str = '<form action="'.$url.'" style="display: inline-block;" method="POST" onsubmit="return confirm(\''.$message.'\');">';
        $str .= '<input type="hidden" name="_method" value="DELETE" />';
        $str .= '<input type="hidden" name="_token" value="'.csrf_token().'" />';
        $str .= '<button type="submit" class="btn btn-sm btn-outline-danger"><i class="fa fa-trash"></i> '.$text.'</button>';
        $str .= '</form>';

        return $str;
    }
}
