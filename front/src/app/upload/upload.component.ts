import { Component, EventEmitter, Output } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { TableService } from '../table/table.service';

@Component({
  selector: 'app-upload',
  templateUrl: './upload.component.html',
  styleUrls: ['./upload.component.css'],
})
export class UploadComponent {
  selectedFile: File | null = null;

  @Output() fileUploaded: EventEmitter<any> = new EventEmitter();

  constructor(private http: HttpClient, private tableService: TableService) {}

  onFileSelected(event: any) {
    this.selectedFile = event.target.files[0];
  }

  uploadFile() {
    if (!this.selectedFile) {
      alert('Veuillez importer un fichier excel.');
      return;
    }

    const formData = new FormData();
    formData.append('file', this.selectedFile, this.selectedFile.name);

    this.http.post('http://localhost:80/api/file/upload', formData).subscribe(
      (response) => {
        alert('Fichier uploadé');
        this.fileUploaded.emit(true);
      },
      (error) => {
        alert("Erreur lors de l'upload");
      }
    );
  }
}
