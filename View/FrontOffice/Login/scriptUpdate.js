document.addEventListener('DOMContentLoaded', function () {
    const signupBtn = document.getElementById('signupBtn');
    const signinBtn = document.getElementById('signinBtn');
    const signupModal = document.getElementById('signupModal');
    const closeModal = document.getElementById('closeModal');
    const step2Modal = document.getElementById('step2Modal');
    const closeStep2Modal = document.getElementById('closeStep2Modal');
    const nextStep = document.getElementById('nextStep');
    const prevStep = document.getElementById('prevStep');
    const signupBtnFinal = document.getElementById('signupBtnFinal');
    const acceptTerms = document.getElementById('acceptTerms');

    
    
        signupModal.style.display = 'block';
        document.body.style.overflow = 'hidden';
    

    

    closeModal.addEventListener('click', function () {
        signupModal.style.display = 'none';
        document.body.style.overflow = 'auto';
    });

    signinBtn.onclick = function () {
        nameField.style.maxHeight = '0';
        nameField1.style.maxHeight = '0';
        title.innerHTML = 'Sign in';
        signupBtn.classList.add('disable');
        signinBtn.classList.remove('disable');
    }

    nextStep.addEventListener('click', function () {
        signupModal.style.display = 'none';
        step2Modal.style.display = 'block';
    });

    closeStep2Modal.addEventListener('click', function () {
        step2Modal.style.display = 'none';
        document.body.style.overflow = 'auto';
    });

    prevStep.addEventListener('click', function () {
        signupModal.style.display = 'block';
        step2Modal.style.display = 'none';
        document.body.style.overflow = 'hidden';
    });

    acceptTerms.addEventListener('change', function () {
        if (acceptTerms.checked) {
            signupBtnFinal.classList.remove('disable');
        } else {
            signupBtnFinal.classList.add('disable');
        }
    });


    signinBtn.addEventListener('click', function () {
        signinModal.style.display = 'block';
        document.body.style.overflow = 'hidden';
    });

    closeSigninModal.addEventListener('click', function () {
        signinModal.style.display = 'none';
        document.body.style.overflow = 'auto';
    });

});




