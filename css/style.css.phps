/* -------------------------------- 

Primary style

-------------------------------- */
html * {
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
}

*, *:after, *:before {
  -webkit-box-sizing: border-box;
  -moz-box-sizing: border-box;
  box-sizing: border-box;
}

body {
  font-size: 100%;
  font-family: "PT Sans", sans-serif;
  color: #505260;
  background-color: black;
}

a {
  color: #2f889a;
  text-decoration: none;
}

img {
  max-width: 100%;
}

input, textarea {
  font-family: "PT Sans", sans-serif;
  font-size: 16px;
  font-size: 1rem;
}
input::-ms-clear, textarea::-ms-clear {
  display: none;
}

/* -------------------------------- 

Main components 

-------------------------------- */
header[role=banner] {
  position: relative;
  height: 50px;
  background:  #4caf50;
}
header[role=banner] #cd-logo {
  float: left;
  margin: 4px 0 0 5%;
  /* reduce logo size on mobile and make sure it is left aligned with the transform-origin property */
  -webkit-transform-origin: 0 50%;
  -moz-transform-origin: 0 50%;
  -ms-transform-origin: 0 50%;
  -o-transform-origin: 0 50%;
  transform-origin: 0 50%;
  -webkit-transform: scale(0.8);
  -moz-transform: scale(0.8);
  -ms-transform: scale(0.8);
  -o-transform: scale(0.8);
  transform: scale(0.8);
}
header[role=banner] #cd-logo img {
  display: block;
}
header[role=banner]::after {
  /* clearfix */
  content: '';
  display: table;
  clear: both;
}
@media only screen and (min-width: 768px) {
  header[role=banner] {
    height: 80px;
  }
  header[role=banner] #cd-logo {
    margin: 20px 0 0 5%;
    -webkit-transform: scale(1);
    -moz-transform: scale(1);
    -ms-transform: scale(1);
    -o-transform: scale(1);
    transform: scale(1);
  }
}

.main-nav {
  float: right;
  margin-right: 5%;
  width: 44px;
  height: 100%;
  background: url("../img/cd-icon-menu.svg") no-repeat center center;
  cursor: pointer;
}
.main-nav ul {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  -webkit-transform: translateY(-100%);
  -moz-transform: translateY(-100%);
  -ms-transform: translateY(-100%);
  -o-transform: translateY(-100%);
  transform: translateY(-100%);
}
.main-nav ul.is-visible {
  -webkit-transform: translateY(50px);
  -moz-transform: translateY(50px);
  -ms-transform: translateY(50px);
  -o-transform: translateY(50px);
  transform: translateY(50px);
}
.main-nav a {
  display: block;
  height: 50px;
  line-height: 50px;
  padding-left: 5%;
  background: #292a34;
  border-top: 1px solid #3b3d4b;
  color: #FFF;
}
@media only screen and (min-width: 768px) {
  .main-nav {
    width: auto;
    height: auto;
    background: none;
    cursor: auto;
  }
  .main-nav ul {
    position: static;
    width: auto;
    -webkit-transform: translateY(0);
    -moz-transform: translateY(0);
    -ms-transform: translateY(0);
    -o-transform: translateY(0);
    transform: translateY(0);
    line-height: 80px;
  }
  .main-nav ul.is-visible {
    -webkit-transform: translateY(0);
    -moz-transform: translateY(0);
    -ms-transform: translateY(0);
    -o-transform: translateY(0);
    transform: translateY(0);
  }
  .main-nav li {
    display: inline-block;
    margin-left: 1em;
  }
  .main-nav li:nth-last-child(2) {
    margin-left: 2em;
  }
  .main-nav a {
    display: inline-block;
    height: auto;
    line-height: normal;
    background: transparent;
  }
  .main-nav a.cd-signin, .main-nav a.cd-signup {
    padding: .6em 1em;
    border: 1px solid rgba(255, 255, 255, 0.6);
    border-radius: 50em;
  }
  .main-nav a.cd-signup {
    background: black;
    color: white;
    border: none;
  }
  .main-nav a.cd-signin {
    background: black;
    color: white;
    border: none;
  }
}

/* -------------------------------- 

xsigin/signup popup 

-------------------------------- */
.cd-user-modal {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background: rgba(52, 54, 66, 0.9);
  z-index: 3;
  overflow-y: auto;
  cursor: pointer;
  visibility: hidden;
  opacity: 0;
  -webkit-transition: opacity 0.3s 0, visibility 0 0.3s;
  -moz-transition: opacity 0.3s 0, visibility 0 0.3s;
  transition: opacity 0.3s 0, visibility 0 0.3s;
}
.cd-user-modal.is-visible {
  visibility: visible;
  opacity: 1;
  -webkit-transition: opacity 0.3s 0, visibility 0 0;
  -moz-transition: opacity 0.3s 0, visibility 0 0;
  transition: opacity 0.3s 0, visibility 0 0;
}
.cd-user-modal.is-visible .cd-user-modal-container {
  -webkit-transform: translateY(0);
  -moz-transform: translateY(0);
  -ms-transform: translateY(0);
  -o-transform: translateY(0);
  transform: translateY(0);
}

.cd-user-modal-container {
  position: relative;
  width: 90%;
  max-width: 600px;
  background: #FFF;
  margin: 3em auto 4em;
  cursor: auto;
  border-radius: 0.25em;
  -webkit-transform: translateY(-30px);
  -moz-transform: translateY(-30px);
  -ms-transform: translateY(-30px);
  -o-transform: translateY(-30px);
  transform: translateY(-30px);
  -webkit-transition-property: -webkit-transform;
  -moz-transition-property: -moz-transform;
  transition-property: transform;
  -webkit-transition-duration: 0.3s;
  -moz-transition-duration: 0.3s;
  transition-duration: 0.3s;
}
.cd-user-modal-container .cd-switcher:after {
  content: "";
  display: table;
  clear: both;
}
.cd-user-modal-container .cd-switcher li {
  width: 50%;
  float: left;
  text-align: center;
}
.cd-user-modal-container .cd-switcher li:first-child a {
  border-radius: .25em 0 0 0;
}
.cd-user-modal-container .cd-switcher li:last-child a {
  border-radius: 0 .25em 0 0;
}
.cd-user-modal-container .cd-switcher a {
  display: block;
  width: 100%;
  height: 50px;
  line-height: 50px;
  background: #d2d8d8;
  color: #809191;
}
.cd-user-modal-container .cd-switcher a.selected {
  background: #FFF;
  color: #505260;
}
@media only screen and (min-width: 600px) {
  .cd-user-modal-container {
    margin: 4em auto;
  }
  .cd-user-modal-container .cd-switcher a {
    height: 70px;
    line-height: 70px;
  }
}

.cd-form {
  padding: 1.4em;
}
.cd-form .fieldset {
  position: relative;
  margin: 1.4em 0;
}
.cd-form .fieldset:first-child {
  margin-top: 0;
}
.cd-form .fieldset:last-child {
  margin-bottom: 0;
}
.cd-form label {
  font-size: 14px;
  font-size: 0.875rem;
}
.cd-form label.image-replace {
  /* replace text with an icon */
  display: inline-block;
  position: absolute;
  left: 15px;
  top: 50%;
  bottom: auto;
  -webkit-transform: translateY(-50%);
  -moz-transform: translateY(-50%);
  -ms-transform: translateY(-50%);
  -o-transform: translateY(-50%);
  transform: translateY(-50%);
  height: 28px;
  width: 30px;
  overflow: hidden;
  text-indent: 100%;
  white-space: nowrap;
  color: transparent;
  text-shadow: none;
  background-repeat: no-repeat;
  background-position: 50% 0;
}
.cd-form label.cd-username {
  background-image: url("../img/cd-icon-username.svg");
}
.cd-form label.cd-email {
  background-image: url("../img/icon-police.svg");
}
.cd-form label.cd-password {
  background-image: url("../img/pass2.svg");
}
.cd-form input {
  margin: 0;
  padding: 0;
  border-radius: 0.25em;
}
.cd-form input.full-width {
  width: 100%;
}
.cd-form input.has-padding {
  padding: 12px 20px 12px 50px;
}
.cd-form input.has-border {
  border: 1px solid #d2d8d8;
  -webkit-appearance: none;
  -moz-appearance: none;
  -ms-appearance: none;
  -o-appearance: none;
  appearance: none;
}
.cd-form input.has-border:focus {
  border-color: #343642;
  box-shadow: 0 0 5px rgba(52, 54, 66, 0.1);
  outline: none;
}
.cd-form input.has-error {
  border: 1px solid #d76666;
}
.cd-form input[type=password] {
  /* space left for the HIDE button */
  padding-right: 65px;
}
.cd-form input[type=submit] {
  padding: 16px 0;
  cursor: pointer;
  background: #27ae60;
  color: #FFF;
  font-weight: bold;
  border: none;
  -webkit-appearance: none;
  -moz-appearance: none;
  -ms-appearance: none;
  -o-appearance: none;
  appearance: none;
}
.no-touch .cd-form input[type=submit]:hover, .no-touch .cd-form input[type=submit]:focus {
  background: #27ae60;
  outline: none;
}
.cd-form .hide-password {
  display: inline-block;
  position: absolute;
  right: 0;
  top: 0;
  padding: 6px 15px;
  border-left: 1px solid #d2d8d8;
  top: 50%;
  bottom: auto;
  -webkit-transform: translateY(-50%);
  -moz-transform: translateY(-50%);
  -ms-transform: translateY(-50%);
  -o-transform: translateY(-50%);
  transform: translateY(-50%);
  font-size: 14px;
  font-size: 0.875rem;
  color: #343642;
}
.cd-form .cd-error-message {
  display: inline-block;
  position: absolute;
  left: -5px;
  bottom: -35px;
  background: rgba(215, 102, 102, 0.9);
  padding: .8em;
  z-index: 2;
  color: #FFF;
  font-size: 13px;
  font-size: 0.8125rem;
  border-radius: 0.25em;
  /* prevent click and touch events */
  pointer-events: none;
  visibility: hidden;
  opacity: 0;
  -webkit-transition: opacity 0.2s 0, visibility 0 0.2s;
  -moz-transition: opacity 0.2s 0, visibility 0 0.2s;
  transition: opacity 0.2s 0, visibility 0 0.2s;
}
.cd-form .cd-error-message::after {
  /* triangle */
  content: '';
  position: absolute;
  left: 22px;
  bottom: 100%;
  height: 0;
  width: 0;
  border-left: 8px solid transparent;
  border-right: 8px solid transparent;
  border-bottom: 8px solid rgba(215, 102, 102, 0.9);
}
.cd-form .cd-error-message.is-visible {
  opacity: 1;
  visibility: visible;
  -webkit-transition: opacity 0.2s 0, visibility 0 0;
  -moz-transition: opacity 0.2s 0, visibility 0 0;
  transition: opacity 0.2s 0, visibility 0 0;
}
@media only screen and (min-width: 600px) {
  .cd-form {
    padding: 2em;
  }
  .cd-form .fieldset {
    margin: 2em 0;
  }
  .cd-form .fieldset:first-child {
    margin-top: 0;
  }
  .cd-form .fieldset:last-child {
    margin-bottom: 0;
  }
  .cd-form input.has-padding {
    padding: 16px 20px 16px 50px;
  }
  .cd-form input[type=submit] {
    padding: 16px 0;
  }
}

.cd-form-message {
  padding: 1.4em 1.4em 0;
  font-size: 14px;
  font-size: 0.875rem;
  line-height: 1.4;
  text-align: center;
}
@media only screen and (min-width: 600px) {
  .cd-form-message {
    padding: 2em 2em 0;
  }
}

.cd-form-bottom-message {
  position: absolute;
  width: 100%;
  left: 0;
  bottom: -30px;
  text-align: center;
  font-size: 14px;
  font-size: 0.875rem;
}
.cd-form-bottom-message a {
  color: #FFF;
  text-decoration: underline;
}

.cd-close-form {
  /* form X button on top right */
  display: block;
  position: absolute;
  width: 40px;
  height: 40px;
  right: 0;
  top: -40px;
  background: url("../img/cd-icon-close.svg") no-repeat center center;
  text-indent: 100%;
  white-space: nowrap;
  overflow: hidden;
}
@media only screen and (min-width: 1170px) {
  .cd-close-form {
    display: none;
  }
}

#cd-login, #cd-signup, #cd-reset-password {
  display: none;
}

#cd-login.is-selected, #cd-signup.is-selected, #cd-reset-password.is-selected {
  display: block;
}

@media only screen and (min-width: 768px) {
  header {
    padding: 4em 0 2em;
  }
  header h1 {
    font-size: 3.2rem;
    font-weight: 300;
  }
}

.cd-filter {
  /* SVG animation style switcher - not needed in production */
  margin-top: 1em;
  text-align: center;
}
.cd-filter li {
  display: inline-block;
  margin: 4px;
}
.cd-filter a {
  display: block;
  border-bottom: 2px solid rgba(76, 92, 98, 0);
  padding: .8em 1em;
  font-size: 1.2rem;
  font-weight: bold;
  text-transform: uppercase;
  letter-spacing: .1em;
  color: #4c5c62;
}
.no-touch .cd-filter a:hover {
  border-bottom: 2px solid rgba(76, 92, 98, 0.6);
}
.cd-filter a.selected {
  color: #00A7E1;
  border-bottom: 2px solid rgba(0, 167, 225, 0.4);
}
.no-touch .cd-filter a.selected:hover {
  border-bottom: 2px solid rgba(0, 167, 225, 0.4);
}
@media only screen and (min-width: 768px) {
  .cd-filter {
    margin-top: 2em;
  }
}

/* -------------------------------- 

Slider

-------------------------------- */
.cd-slider-wrapper {
  position: relative;
  width: 90%;
  max-width: 1024px;
  margin: 2em auto;
  /* hide horizontal scrollbar on IE11 */
  overflow-x: hidden;
}

.cd-slider > li {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  opacity: 0;
  /* hide vertical scrollbar on IE11 */
  overflow: hidden;
}
.cd-slider > li.visible {
  position: relative;
  z-index: 2;
  opacity: 1;
}
.cd-slider > li.is-animating {
  z-index: 3;
  opacity: 1;
}

.cd-slider .cd-svg-wrapper {
  /* using padding Hack to fix bug on IE - svg height not properly calculated */
  height: 0;
  padding-bottom: 45%;
  padding-top: 20%;
  padding-right: 80%;
}

.cd-slider-wrapper svg {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
}

/* -------------------------------- 

Slider navigation

-------------------------------- */
.cd-slider-navigation li {
  position: absolute;
  z-index: 3;
  top: 50%;
  bottom: auto;
  -webkit-transform: translateY(-50%);
  -moz-transform: translateY(-50%);
  -ms-transform: translateY(-50%);
  -o-transform: translateY(-50%);
  transform: translateY(-50%);
  right: 150px;
  height: 80px;
  width: 48px;
  text-align: center;
}
.cd-slider-navigation li a {
  display: block;
  height: 100%;
  overflow: hidden;
  text-indent: 100%;
  white-space: nowrap;
  color: transparent;
  background: url(../img/cd-icon-arrows.svg) no-repeat 0 0;
  -webkit-transition: -webkit-transform 0.2s;
  -moz-transition: -moz-transform 0.2s;
  transition: transform 0.2s;
}
.no-touch .cd-slider-navigation li a:hover {
  -webkit-transform: scale(1.1);
  -moz-transform: scale(1.1);
  -ms-transform: scale(1.1);
  -o-transform: scale(1.1);
  transform: scale(1.1);
}
.cd-slider-navigation li:last-of-type {
  left: 10px;
  right: auto;
}
.cd-slider-navigation li:last-of-type a {
  background-position: -48px 0;
}

/* -------------------------------- 

Slider dots/controls 

-------------------------------- */
.cd-slider-controls {
  position: absolute;
  bottom: 20px;
  left: 50%;
  right: auto;
  -webkit-transform: translateX(-50%);
  -moz-transform: translateX(-50%);
  -ms-transform: translateX(-50%);
  -o-transform: translateX(-50%);
  transform: translateX(-50%);
  z-index: 3;
  text-align: center;
  width: 90%;
}
.cd-slider-controls::after {
  clear: both;
  content: "";
  display: table;
}
.cd-slider-controls li {
  display: inline-block;
  margin-right: 10px;
}
.cd-slider-controls li:last-of-type {
  margin-right: 0;
}
.cd-slider-controls li.selected a {
  background-color: #ffffff;
}
.cd-slider-controls a {
  display: block;
  /* image replacement */
  overflow: hidden;
  text-indent: 100%;
  white-space: nowrap;
  color: transparent;
  height: 10px;
  width: 10px;
  border-radius: 50%;
  border: 2px solid #ffffff;
}
.no-touch .cd-slider-controls a:hover {
  background-color: #ffffff;
}
