<?php
//start php session
session_start();

//check session variables and display messages if needed
if (!empty($_SESSION['registration_error']) && $_SESSION['registration_error']) {
  $notice = 'Please Try Again';
  $_SESSION['registration_error'] = '';
} else if (!empty($_SESSION['email_taken']) && $_SESSION['email_taken']) {
  $notice = 'Email is Taken';
  $_SESSION['email_taken'] = '';
} else if (!empty($_SESSION['passMiss']) && $_SESSION['passMiss']) {
  $notice = 'Passwords Do Not Match, Please Try Again';
  $_SESSION['passMiss'] = '';
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <title>Customer Registration</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
  <nav class="navbar navbar-dark bg-dark">
    <div class="container-fluid">
      <a class="navbar-brand mx-auto" href="./index.php">Sporting Goods Emporium</a>
    </div>
  </nav>
</head>

<body>
  <div class="alert alert-info text-center mb-0" role="alert" style="border-radius:0;">
    <strong>Educational Use Only:</strong> This site is for educational purposes. All content, data, and entities are entirely fictitious.
  </div>

  <div class="container">
    <h1 class="text-center">Customer Registration</h1>
    <center>
      <h1>
        <div style='color: red;'><?php if (!empty($notice)) {
                                    echo $notice;
                                  } ?></div>
      </h1>
    </center>
    <form method="POST" class="form-horizontal" action="./scripts/registrationCheck.php" oninput='repassword.setCustomValidity(repassword.value != password.value ? "Passwords do not match." : "")'>

      <div class=" form-group row mb-2">
        <label class="col-form-label col-sm-2" for="email">Email:</label>
        <div class="col-sm-10">
          <input required type="email" class="form-control" id="email" placeholder="example@example.com" name="email" pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$">
        </div>
      </div>

      <div class=" form-group row mb-2">
        <label class="col-form-label col-sm-2" for="password">Password:</label>
        <div class="col-sm-10">
          <input required type="password" class="form-control" id="password" placeholder="Enter Password" name="password">
        </div>
      </div>

      <div class=" form-group row mb-2">
        <label class="col-form-label col-sm-2" for="repassword">Retype Password:</label>
        <div class="col-sm-10">
          <input required type="password" class="form-control" id="repassword" placeholder="Reenter Password" name="repassword">
        </div>
      </div>

      <div class=" form-group row mb-2">
        <label class="col-form-label col-sm-2" for="first_name">First Name:</label>
        <div class="col-sm-10">
          <input required type="text" class="form-control" id="first_name" placeholder="Enter First Name" name="firstName">
        </div>
      </div>

      <div class=" form-group row mb-2">
        <label class="col-form-label col-sm-2" for="last_name">Last Name:</label>
        <div class="col-sm-10">
          <input required type="text" class="form-control" id="last_name" placeholder="Enter Last Name" name="lastName">
        </div>
      </div>

      <div class=" form-group row mb-2">
        <label class="col-form-label col-sm-2" for="phone_num">Phone Number:</label>
        <div class="col-sm-10">
          <input required type="text" class="form-control" id="phone_num" placeholder="999-999-9999" name="phoneNum" pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}">
        </div>
      </div>

      <div class=" form-group row mb-2">
        <label class="col-form-label col-sm-2" for="address">Street Address:</label>
        <div class="col-sm-10">
          <input required type="text" class="form-control" id="address" name="address">
        </div>
      </div>

      <div class=" form-group row mb-2">
        <label class="col-form-label col-sm-2" for="city">City:</label>
        <div class="col-sm-10">
          <input required type="text" class="form-control" id="city" name="city">
        </div>
      </div>

      <div class=" form-group row mb-2">
        <label class="col-form-label col-sm-2" for="state">State:</label>
        <div class="col-sm-10">
          <select id="state" name="state" class="form-control" required>
            <option value=''>Select a State</option>
            <option value="AL">Alabama</option>
            <option value="AK">Alaska</option>
            <option value="AZ">Arizona</option>
            <option value="AR">Arkansas</option>
            <option value="CA">California</option>
            <option value="CO">Colorado</option>
            <option value="CT">Connecticut</option>
            <option value="DE">Delaware</option>
            <option value="FL">Florida</option>
            <option value="GA">Georgia</option>
            <option value="HI">Hawaii</option>
            <option value="ID">Idaho</option>
            <option value="IL">Illinois</option>
            <option value="IN">Indiana</option>
            <option value="IA">Iowa</option>
            <option value="KS">Kansas</option>
            <option value="KY">Kentucky</option>
            <option value="LA">Louisiana</option>
            <option value="ME">Maine</option>
            <option value="MD">Maryland</option>
            <option value="MA">Massachusetts</option>
            <option value="MI">Michigan</option>
            <option value="MN">Minnesota</option>
            <option value="MS">Mississippi</option>
            <option value="MO">Missouri</option>
            <option value="MT">Montana</option>
            <option value="NE">Nebraska</option>
            <option value="NV">Nevada</option>
            <option value="NH">New Hampshire</option>
            <option value="NJ">New Jersey</option>
            <option value="NM">New Mexico</option>
            <option value="NY">New York</option>
            <option value="NC">North Carolina</option>
            <option value="ND">North Dakota</option>
            <option value="OH">Ohio</option>
            <option value="OK">Oklahoma</option>
            <option value="OR">Oregon</option>
            <option value="PA">Pennsylvania</option>
            <option value="RI">Rhode Island</option>
            <option value="SC">South Carolina</option>
            <option value="SD">South Dakota</option>
            <option value="TN">Tennessee</option>
            <option value="TX">Texas</option>
            <option value="UT">Utah</option>
            <option value="VT">Vermont</option>
            <option value="VA">Virginia</option>
            <option value="WA">Washington</option>
            <option value="WV">West Virginia</option>
            <option value="WI">Wisconsin</option>
            <option value="WY">Wyoming</option>
          </select>
        </div>
      </div>

      <div class=" form-group row mb-2">
        <label class="col-form-label col-sm-2" for="zipcode">Zip code:</label>
        <div class="col-sm-10">
          <input required type="text" class="form-control" id="zipcode" name="zipcode">
        </div>
      </div>

      <div class="form-group row">
        <div class="offset-sm-2 col-sm-10 mt-2">
          <button type="submit" class="btn btn-success">Create Account</button>
          <button type="reset" class="btn btn-danger">Clear</button>
        </div>
      </div>
    </form>
    <div class="offset-sm-2 col-sm-10 mt-2">
      <br>
      Already have an Account?
      <br>
      <a href="./login.php"><button type="button" class="btn btn-primary mt-2">Login</button></a>
      <div>
      </div>
</body>

</html>