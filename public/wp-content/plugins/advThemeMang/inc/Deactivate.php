<?php

namespace Inc;
class Deactivate {
    static function deactivate() {
        flush_rewrite_rules();
    }
}