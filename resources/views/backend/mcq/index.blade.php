@extends('backend.layouts.main')
@section('main-container')
<head>
    <!-- Font Awesome -->
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
    />

    <!-- Custom Style -->
    <link rel="stylesheet" href="http://localhost/kb/public/assets/css/style.css" />

    <!-- animation -->
    <link rel="stylesheet" href="http://localhost/kb/public/assets/css/animation.css" />

    <!-- Responsive -->
    <link rel="stylesheet" href="http://localhost/kb/public/assets/css/responsive.css" />

    <!-- result CSS -->
    <link rel="stylesheet" href="http://localhost/kb/public/assets/css/result_style.css" />
  </head>
<main class="overflow-hidden">
      <div class="container">
        <!-- Steps Start -->
        <section class="steps">
          <form
            novalidate
            onsubmit="return false"
            class="show-section"
            id="stepForm"
          >
            <!-- Step 1 -->
            <fieldset id="step1">
              <!-- Question -->
              <h1 class="question">
                What are the two corporate divisions of Knorr-Bremse AG?
              </h1>

              <!-- Options -->
              <div class="options d-flex flex-wrap justify-content-between">
                <div class="option animate">
                  <input type="radio" name="op1" value="Rail Vehicle Systems and Powertrain Systems" />
                  <label>Rail Vehicle Systems and Powertrain Systems</label>
                </div>
                <div class="option animate delay-100">
                  <input type="radio" name="op1" value="Commercial Vehicle Systems and Torsional Vibration Dampers" />
                  <label>Commercial Vehicle Systems and Torsional Vibration Dampers</label>
                </div>
                <div class="option animate delay-200">
                  <input type="radio" name="op1" value="Rail Vehicle Systems and Commercial Vehicle Systems" />
                  <label>Rail Vehicle Systems and Commercial Vehicle Systems</label>
                </div>
                <div class="option animate delay-300">
                  <input type="radio" name="op1" value="Electronic Control Systems and Driver Assistance Systems" />
                  <label>Electronic Control Systems and Driver Assistance Systems</label>
                </div>
              </div>

              <!-- Next Prev Button -->
              <div class="nextPrev">
                <button class="prev" type="button">
                  <i class="fa-solid fa-caret-left"></i>
                </button>

                <!-- COunter -->
                <div class="stepCount"><span>1</span>/4</div>
                <button class="next" type="button" id="step1btn">
                  <i class="fa-solid fa-caret-right"></i>
                </button>
              </div>
            </fieldset>

            <!-- Step 2 -->
            <fieldset id="step2">
              <!-- Question -->
              <h1 class="question">
                  What is Knorr-Bremse Commercial Vehicle Systems known for?
              </h1>

              <!-- Options -->
              <div class="options d-flex flex-wrap justify-content-between">
                <div class="option animate">
                  <input type="radio" name="op2" value="Manufacturing trucks and buses" />
                  <label>Manufacturing trucks and buses</label>
                </div>
                <div class="option animate delay-100">
                  <input type="radio" name="op2" value="Providing safety systems for road vehicles" />
                  <label>Providing safety systems for road vehicles</label>
                </div>
                <div class="option animate delay-200">
                  <input type="radio" name="op2" value="Producing diesel engines" />
                  <label>Producing diesel engines</label>
                </div>
                <div class="option animate delay-300">
                  <input type="radio" name="op2" value="Offering powertrain systems" />
                  <label>Offering powertrain systems</label>
                </div>
              </div>

              <!-- Next Prev Button -->
              <div class="nextPrev">
                <button class="prev" type="button">
                  <i class="fa-solid fa-caret-left"></i>
                </button>

                <!-- COunter -->
                <div class="stepCount"><span>2</span>/4</div>
                <button class="next" type="button" id="step2btn">
                  <i class="fa-solid fa-caret-right"></i>
                </button>
              </div>
            </fieldset>

            <!-- Step 3 -->
            <fieldset id="step3">
              <!-- Question -->
              <h1 class="question">
              Which region is not mentioned as part of Knorr-Bremse AG's operations structure?
              </h1>

              <!-- Options -->
              <div class="options d-flex flex-wrap justify-content-between">
                <div class="option animate">
                  <input type="radio" name="op3" value="Europe/Africa/Middle East" />
                  <label>Europe/Africa/Middle East</label>
                </div>
                <div class="option animate delay-100">
                  <input type="radio" name="op3" value="North America" />
                  <label>North America</label>
                </div>
                <div class="option animate delay-200">
                  <input type="radio" name="op3" value="Central America" />
                  <label>Central America</label>
                </div>
                <div class="option animate delay-300">
                  <input type="radio" name="op3" value="Asia/Australia" />
                  <label>Asia/Australia</label>
                </div>
              </div>

              <!-- Next Prev Button -->
              <div class="nextPrev">
                <button class="prev" type="button">
                  <i class="fa-solid fa-caret-left"></i>
                </button>

                <!-- COunter -->
                <div class="stepCount"><span>3</span>/4</div>
                <button class="next" type="button" id="step3btn">
                  <i class="fa-solid fa-caret-right"></i>
                </button>
              </div>
            </fieldset>

            <!-- Step 4 -->
            <fieldset id="step4">
              <!-- Question -->
              <h1 class="question">
                How many employees does the Commercial Vehicle Systems division have?
              </h1>

              <!-- Options -->
              <div class="options d-flex flex-wrap justify-content-between">
                <div class="option animate">
                  <input type="radio" name="op4" value="Over 9,000" />
                  <label>Over 9,000</label>
                </div>
                <div class="option animate delay-100">
                  <input type="radio" name="op4" value="Over 10,000" />
                  <label>Over 10,000</label>
                </div>
                <div class="option animate delay-200">
                  <input type="radio" name="op4" value="Over 8,000" />
                  <label>Over 8,000</label>
                </div>
                <div class="option animate delay-300">
                  <input type="radio" name="op4" value="Over 7,000" />
                  <label>Over 7,000</label>
                </div>
              </div>

              <!-- Next Prev Button -->
              <div class="nextPrev">
                <button class="prev" type="button">
                  <i class="fa-solid fa-caret-left"></i>
                </button>

                <!-- COunter -->
                <div class="stepCount"><span>4</span>/4</div>
                <button class="apply" type="button" id="sub">
                  <i class="fa-solid fa-caret-right"></i>
                </button>
              </div>
            </fieldset>
          </form>

          <img class="avatar" src="http://localhost/kb/public/assets/images/avatar.png" alt="Avatar" />
          <div class="backgroundSlab"></div>
        </section>
      </div>
    </main>
    <!-- result -->
    <div class="loadingresult">
      <img src="http://localhost/kb/public/assets/images/loading.gif" alt="loading" />
    </div>
    <div class="result_page">
      <div class="container">
        <div class="result_inner">
          <!-- header -->
          <header class="resultheader">
            Your Result is there
            <div class="h-border"></div>
          </header>

          <div class="result_content">
            <div class="result_msg">
              <img src="http://localhost/kb/public/assets/images/check.png" alt="check" />
              Wow! You are Brilliant!
            </div>
            <span>your overall score</span>
            <div class="u_prcnt">70%</div>
            <div class="prcnt_bar">
              <div class="fill"></div>
            </div>
            <div class="prcnt_bar_lvl">Medium</div>
            <div class="lvl_overview">
              <div class="lvl-single">
                <div class="lvl-color low"></div>
                <div class="lvl-name">Low</div>
                <div class="lvl-line"></div>
              </div>
              <div class="lvl-single">
                <div class="lvl-color medium"></div>
                <div class="lvl-name">Medium</div>
                <div class="lvl-line"></div>
              </div>
              <div class="lvl-single">
                <div class="lvl-color high"></div>
                <div class="lvl-name">High</div>
              </div>
            </div>
          </div>

          <footer class="resultfooter"></footer>
        </div>
      </div>
    </div>

    <div id="error"></div>

    <!-- Bootstrap JS -->
    <script src="http://localhost/kb/public/assets/js/Bootstrap/bootstrap.min.js"></script>

    <!-- jQuery -->
    <script src="http://localhost/kb/public/assets/js/jQuery/jquery-3.7.1.min.js"></script>
    <!-- Result JS -->
    <script src="http://localhost/kb/public/assets/js/result.js"></script>
    <!-- Custom JS -->
    <script src="http://localhost/kb/public/assets/js/custom.js"></script>
@endsection 
