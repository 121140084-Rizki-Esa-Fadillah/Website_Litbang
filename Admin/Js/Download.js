document.addEventListener('DOMContentLoaded', () => {
      document.getElementById('downloadBtn').addEventListener('click', () => {
          const { jsPDF } = window.jspdf;
          const content = document.getElementById('content');
  
          html2canvas(content, { scale: 2 }).then(canvas => {
              const imgData = canvas.toDataURL('image/png');
              const doc = new jsPDF({
                  orientation: 'p',
                  unit: 'mm',
                  format: 'a4'
              });
  
              const imgWidth = 210; // width of A4 in mm
              const pageHeight = 295; // height of A4 in mm
              const imgHeight = canvas.height * imgWidth / canvas.width;
              let heightLeft = imgHeight;
  
              let position = 0;
  
              doc.addImage(imgData, 'PNG', 0, position, imgWidth, imgHeight);
              heightLeft -= pageHeight;
  
              while (heightLeft >= 0) {
                  position -= pageHeight;
                  doc.addPage();
                  doc.addImage(imgData, 'PNG', 0, position, imgWidth, imgHeight);
                  heightLeft -= pageHeight;
              }
  
              // Final save call
              doc.save('content.pdf');
          });
      });
  });
  