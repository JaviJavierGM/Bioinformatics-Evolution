import { ComponentFixture, TestBed } from '@angular/core/testing';

import { FoldingComponent } from './folding.component';

describe('FoldingComponent', () => {
  let component: FoldingComponent;
  let fixture: ComponentFixture<FoldingComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      declarations: [ FoldingComponent ]
    })
    .compileComponents();
  });

  beforeEach(() => {
    fixture = TestBed.createComponent(FoldingComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
