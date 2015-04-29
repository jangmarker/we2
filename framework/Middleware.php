<?php
namespace framework;


interface Middleware {
    function onGet(Request $request);
    function onPost(Request $request);
    function onDelete(Request $request);
    function onUpdate(Request $request);
}