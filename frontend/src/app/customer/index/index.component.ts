import { Component, OnInit } from '@angular/core';
import { CustomerService } from '../customer.service';
import { Customer } from '../customer';

@Component({
  selector: 'app-index',
  templateUrl: './index.component.html',
  styleUrls: ['./index.component.css']
})
export class IndexComponent implements OnInit {

  customers: Customer[] = [];

  constructor(public customerService: CustomerService) { }

  ngOnInit(): void {
    this.customerService.getAll().subscribe((data: Customer[])=>{
      this.customers = data;
      console.log(this.customers);
    })  
  }

  deleteCustomer(id:number){
    this.customerService.delete(id).subscribe(res => {
         this.customers = this.customers.filter(item => item.id !== id);
         console.log('Customer deleted successfully!');
    })
  }

}
