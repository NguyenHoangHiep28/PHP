<?php
    function e(){
        echo "This is e() ".'</br>';
    };
    function f(){
        echo "This is f() ".'</br>';
        return 'e';
    };
    function g(){
        echo "This is g() ".'</br>';
        return 'f';
    };
    g();
    echo "**************".'</br>';
    g()();
    echo "**************".'</br>';
    g()()();