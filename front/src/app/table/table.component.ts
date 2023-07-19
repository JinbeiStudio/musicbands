// table.component.ts

import { Component, OnInit, ViewChild } from '@angular/core';
import { TableService } from './table.service';
import { MatTableDataSource } from '@angular/material/table';
import { MatPaginator } from '@angular/material/paginator';

@Component({
  selector: 'app-table',
  templateUrl: './table.component.html',
  styleUrls: ['./table.component.css'],
})
export class TableComponent implements OnInit {
  tableData: any[] = [];
  displayedColumns: string[] = [
    'name',
    'country',
    'city',
    'year',
    'splitYear',
    'founders',
    'membersCount',
    'musicalStyle',
    'description',
    'actions',
  ];

  dataSource: MatTableDataSource<any> = new MatTableDataSource();

  @ViewChild(MatPaginator, { static: true }) paginator!: MatPaginator;

  editable: boolean = false;

  constructor(private tableService: TableService) {}

  ngOnInit() {
    this.fetchTableData();
  }

  fetchTableData() {
    this.tableService.getTableData().subscribe((data) => {
      this.tableData = data['hydra:member'];
      this.dataSource.data = this.tableData;
      this.dataSource.paginator = this.paginator;
    });
  }

  onEdit(row: any) {
    row.editable = true;
  }

  onCellEdit(row: any, column: string, event: any) {
    row[column] = event.target.textContent;
  }

  onSave(row: any) {
    row.year = row.year ? parseInt(row.year) : null;
    row.splitYear = row.splitYear ? parseInt(row.splitYear) : null;
    row.membersCount = row.membersCount ? parseInt(row.membersCount) : null;

    this.tableService.updateRow(row.id, row).subscribe(() => {
      row.editable = false;
    });
  }

  deleteRow(rowId: number) {
    this.tableService.deleteRow(rowId).subscribe(() => {
      this.dataSource.data = this.dataSource.data.filter(
        (row) => row.id !== rowId
      );
    });
  }

  onFileUploaded() {
    this.fetchTableData();
  }
}
