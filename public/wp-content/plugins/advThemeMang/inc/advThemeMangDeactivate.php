<?php
class advThemeMangDeactivate {
    static function deactivate() {
        flush_rewrite_rules();
    }
}