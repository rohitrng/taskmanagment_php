<?php
//  use DB;

//  $classlist = DB::table('class_name')->select('class_name')->distinct()->get();
//  $classlist = DB::table('class_name')->pluck('class_name')->toArray();


return [
    'application_for' => [
       'Day School'
    ],  

    'admission_type' => [
       'CBSE',
       'RTE',
       'Non RTE',
       // 'STAFF',
       // 'A Level'
    ],

    'gender' => [
          'Male',
         'Female',
         'Other',
    ],

    'caste' => [ 
        'Other',
        'Abir',
        'Agrawal',
        'Bairagi',
        'Banjara',
        'Barber',
        'Berwa',
        'Bhawsar',
        'Bhilala',
        'Bhujwa',
        'Brahmin',
        'Chamar'
    ],
    'religion' => [
        'Hindu',
        'Bohra',
        'Islam',
        'Jain',
        'Muslim',
        'Sikh',
        'Other'
    ],
    'cate' => [
        'GEN',
        'ST',
        'SC',
        'OBC',
        'UR'
    ],
    'hearaboutus'=>[
        'By Advertisement',
        'By Exiting Parents',
        'By Alumni Students',
        'By Ex Parents',
        'By Any Other',
        'By Staff Member',
        

    ],
    'enquirythrough' =>[
        'Walk in',
        'Website',
        'Call',
    ],
    'class_name' => [
        'Nursery',
        'KG1',
        'KG2',
        '01',
        '02',
        '03',
        '04',
        '05',
        '06',
        '07',
        '08',
        '09',
        '10',
        '11',


    ],
    'session_name' => [
        '2015-2016',
        '2016-2017',
        '2017-2018',
        '2018-2019',
        '2019-2020',
        '2020-2021',
        '2021-2022',
        '2022-2023',
        '2023-2024',
        '2024-2025',
        '2025-2026',
        '2026-2027',
    ],
    'parents_are' => [
        'parents',
    ],
    'child_live_with' => [
        'parents',
    ],
    'parents_category' => [
        'parents',
    ],
    'house' => [
        'house',
    ],
     'state' => [
        'Madhya Pradesh',
    ],
    'headname' => [
        'admin',
    ],
    'occupation' => [
        'Service',
        'Business',
        'Other',
        'NA',
    ],
    'occupation_mother' => [
        'Housewife',
        'Homemaker',
        'Service',
        'Business',
        'Other',
        'NA',
    ],
    'term' => [
        '1st',
        '2nd',
        '3rd',
        '4th',
    ],
    'receivedammount' =>[
        'Online',
        'Cash',
        'Bank Transfer',
        'Others',
    ],
    'remarkstatus' => [
       'Form Taken',
        'Pending',
        'Cancel',
        'Reject',
        
    ], 
    'section' => [
       'A',
        'B',
        'C',
        'D',
        
    ]  
    
       
    
];