function simulateLoading(){
    const loginBtn = document.getElementById('loginBtn');
    loginBtn.disabled=true;
    loginBtn.innerHTML = '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Loading...';

    setTimeout(() => {
        loginBtn.innerHTML='Login';
        loginBtn.disabled=false;
    },2400);
}

//ajax add student form








