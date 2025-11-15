document.addEventListener('DOMContentLoaded', function() {
  // LICENSE
  // hide documentation unless license terms are agreed
  // (code commented out in original)

  // Menu Links - helper function to hide all sections and show target
  function showSection(sectionId) {
    var sections = document.querySelectorAll('.bodyHeaderContainer');
    sections.forEach(function(section) {
      section.style.display = 'none';
    });
    var targetSection = document.getElementById(sectionId);
    if (targetSection) {
      targetSection.style.display = 'block';
    }
  }

  // Attach click handlers to navigation buttons
  document.getElementById('btnInstallation').addEventListener('click', function(e) {
    e.preventDefault();
    showSection('Installation');
  });
  document.getElementById('btnMigration').addEventListener('click', function(e) {
    e.preventDefault();
    showSection('Migration');
  });
  document.getElementById('btnInstallationTips').addEventListener('click', function(e) {
    e.preventDefault();
    showSection('InstallationTips');
  });
  document.getElementById('btnInstructions').addEventListener('click', function(e) {
    e.preventDefault();
    showSection('Instructions');
  });
  document.getElementById('btnUninstall').addEventListener('click', function(e) {
    e.preventDefault();
    showSection('Uninstall');
  });
  document.getElementById('btnAbout').addEventListener('click', function(e) {
    e.preventDefault();
    showSection('About');
  });
  document.getElementById('btnLicense').addEventListener('click', function(e) {
    e.preventDefault();
    showSection('License');
  });
  document.getElementById('btnDisclaimer').addEventListener('click', function(e) {
    e.preventDefault();
    showSection('Disclaimer');
  });
  document.getElementById('btnHelp').addEventListener('click', function(e) {
    e.preventDefault();
    showSection('Help');
  });

  // CODE BOXES
  // highlight
  if (typeof sh_highlightDocument !== 'undefined') {
    sh_highlightDocument();
  }
  
  // select all functionality - use event delegation on document
  document.addEventListener('click', function(e) {
    if (e.target.classList.contains('select')) {
      var codeElement = e.target.parentElement.nextElementSibling.querySelector('code');
      if (codeElement) {
        selectCode(codeElement);
      }
    }
  });
});

function selectCode(codeElement)
{
  // The code element is already the target
  var e = codeElement;

  // Modern browsers
  if (window.getSelection)
  {
    var s = window.getSelection();
    var r = document.createRange();
    r.selectNodeContents(e);
    s.removeAllRanges();
    s.addRange(r);
  }
  // Legacy IE
  else if (document.selection)
  {
    var r = document.body.createTextRange();
    r.moveToElementText(e);
    r.select();
  }
}