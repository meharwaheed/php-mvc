<?php

namespace Models;

class Student extends Model {
}

// select  name , marks,
// CASE
//     WHEN marks = (select distinct marks from students order by marks*1 desc limit 0,1 ) THEN "1"
//     WHEN marks = (select distinct marks from students order by marks*1 desc limit 1,1 ) THEN "2"
//     ELSE "3"
// END as position from students where marks in (select * from (select marks from students group by marks ORDER by marks+0 desc LIMIT 0,3) as t1) order by marks*1 desc;
