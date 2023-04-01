  // step 1
  const ipnElement = document.querySelector('#ipnPassword')
  const btnElement = document.querySelector('#btnPassword')
  
  // step 2
  btnElement.addEventListener('click', function() {
    // step 3
    const currentType = ipnElement.getAttribute('type')
    // step 4
    ipnElement.setAttribute(
      'type',
      currentType === 'password' ? 'text' : 'password'
    )
  })