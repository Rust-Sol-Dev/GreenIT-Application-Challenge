import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';
import { IndexComponent } from './index/index.component';
import { ViewComponent } from './view/view.component';
import { CreateComponent } from './create/create.component';
import { EditComponent } from './edit/edit.component';
   
const routes: Routes = [
  { path: 'customer', redirectTo: 'customer/index', pathMatch: 'full'},
  { path: 'customer/index', component: IndexComponent },
  { path: 'customer/:customerId/view', component: ViewComponent },
  { path: 'customer/create', component: CreateComponent },
  { path: 'customer/:customerId/edit', component: EditComponent } 
];
   
@NgModule({
  imports: [RouterModule.forChild(routes)],
  exports: [RouterModule]
})
export class CustomerRoutingModule { }
