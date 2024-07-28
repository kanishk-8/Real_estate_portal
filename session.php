<?php
function sec_session_begin()
{
    session_name("MYWEBSITE");
    session_start();
}
sec_session_begin();
