const tableButton = document.getElementById('table-button');
const chartButton = document.getElementById('chart-button');
const tableDiv = document.getElementById('table');
const chartDiv = document.getElementById('chart');

function showTab(tab) {
      if (tab === 'table') {
            tableDiv.style.display = 'block';
            chartDiv.style.display = 'none';
            tableButton.classList.add('active');
            chartButton.classList.remove('active');
      } else if (tab === 'chart') {
            tableDiv.style.display = 'none';
            chartDiv.style.display = 'block';
            tableButton.classList.remove('active');
            chartButton.classList.add('active');
      }
}

tableButton.addEventListener('click', () => showTab('table'));
chartButton.addEventListener('click', () => showTab('chart'));
showTab('table'); // Set default tab