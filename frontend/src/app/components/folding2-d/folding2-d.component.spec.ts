import { ComponentFixture, TestBed } from '@angular/core/testing';

import { Folding2DComponent } from './folding2-d.component';

describe('Folding2DComponent', () => {
  let component: Folding2DComponent;
  let fixture: ComponentFixture<Folding2DComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      declarations: [ Folding2DComponent ]
    })
    .compileComponents();
  });

  beforeEach(() => {
    fixture = TestBed.createComponent(Folding2DComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
