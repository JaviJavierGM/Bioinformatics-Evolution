import { ComponentFixture, TestBed } from '@angular/core/testing';

import { SelectCorrelatedNetworkComponent } from './select-correlated-network.component';

describe('SelectCorrelatedNetworkComponent', () => {
  let component: SelectCorrelatedNetworkComponent;
  let fixture: ComponentFixture<SelectCorrelatedNetworkComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      declarations: [ SelectCorrelatedNetworkComponent ]
    })
    .compileComponents();
  });

  beforeEach(() => {
    fixture = TestBed.createComponent(SelectCorrelatedNetworkComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
