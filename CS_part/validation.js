document.getElementById("bookingForm").addEventListener("submit", function (e) {
  e.preventDefault();

  const name = document.getElementById("name").value.trim();
  const phone = document.getElementById("phone").value.trim();
  const email = document.getElementById("email").value.trim();
  const date = document.getElementById("date").value;
  const time = document.getElementById("time").value;

  // Name Validation
  if (name.length < 3) {
    alert("Name must be at least 3 characters");
    return;
  }

  if (!/^[a-zA-Z\s]+$/.test(name)) {
    alert("Name can only contain letters");
    return;
  }

  // Phone Validation
  if (!/^01\d{8,9}$/.test(phone)) {
    alert("Enter valid Malaysia phone number (01XXXXXXXX)");
    return;
  }

  // Email Validation
  const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
  if (!emailRegex.test(email)) {
    alert("Enter valid email address");
    return;
  }

  // Date Validation
  if (date === "") {
    alert("Select appointment date");
    return;
  }

  const selectedDate = new Date(date);
  const today = new Date();
  today.setHours(0, 0, 0, 0);

  // Block past dates
  if (selectedDate < today) {
    alert("You cannot select a past date");
    return;
  }


  // Time Validation
  if (time === "") {
    alert("Select appointment time");
    return;
  }

  const [hour, minute] = time.split(":").map(Number);

  // Clinic hours validation
  const day = selectedDate.getDay();

  if (day >= 1 && day <= 7) {
    //
    if (hour < 8 || hour >= 20) {
      alert("Clinic hours: 8:00 AM – 8:00 PM (Mon–Thu)");
      return;
    }
  }

  alert("Booking submitted successfully!");
  this.submit();
});
