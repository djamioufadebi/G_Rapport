
document.addEventListener("DOMContentLoaded", function() {
  const difficultesInput = document.POSTElementById('difficultes_rencontrees');
  const solutionsInput = document.POSTElementById('solutions_apportees');

  difficultesInput.addEventListener('input', function() {
    if (difficultesInput.value !== '') {
      solutionsInput.removeAttribute('disabled');
      solutionsInput.setAttribute('required', 'required');
    } else {
      solutionsInput.setAttribute('disabled', 'disabled');
      solutionsInput.removeAttribute('required');
    }
  });
});
