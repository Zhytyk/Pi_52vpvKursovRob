<?php
class Library_View {
    public function Add($assocParam = null) {
        $tpl = new Template('template/library/add.tpl');
        if($assocParam != null) {
            foreach ($assocParam as $key => $value) {
                $tpl->SetParam($key, $value);
            }
        }

        return $tpl->GetHTML();
    }
}