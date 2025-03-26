// Form validation
function validateForm(form) {
    const name = form['name'].value;
    const email = form['email'].value;
 
    if (name === '' || email === '') {
        alert('All fields are required!');
        return false;
    }
    return true;
}
 
// AJAX request example for getting user data
function fetchUserData() {
    const xhr = new XMLHttpRequest();
    xhr.open('GET', 'getUserData.php', true);
    xhr.onload = function() {
        if (xhr.status === 200) {
            const data = JSON.parse(xhr.responseText);
            document.getElementById('user-name').innerText = data.name;
        }
    };
    xhr.send();
}
 
// Call the function on page load
window.onload = fetchUserData;
