// table.service.ts

import { Injectable } from '@angular/core';
import { HttpClient, HttpHeaders } from '@angular/common/http';
import { Observable } from 'rxjs';

@Injectable({
  providedIn: 'root',
})
export class TableService {
  private apiUrl = 'http://localhost:80/api/musical_groups';

  constructor(private http: HttpClient) {}

  public getHeaders(): HttpHeaders {
    const headers = new HttpHeaders({
      'Access-Control-Allow-Origin': '*',
    });
    return headers;
  }

  getTableData(): Observable<any> {
    return this.http.get<any[]>(this.apiUrl);
  }

  addRow(rowData: any): Observable<any> {
    return this.http.post<any>(this.apiUrl, rowData);
  }

  updateRow(rowId: number, rowData: any): Observable<any> {
    return this.http.put<any>(`${this.apiUrl}/${rowId}`, rowData);
  }

  deleteRow(rowId: number): Observable<any> {
    return this.http.delete<any>(`${this.apiUrl}/${rowId}`);
  }
}
