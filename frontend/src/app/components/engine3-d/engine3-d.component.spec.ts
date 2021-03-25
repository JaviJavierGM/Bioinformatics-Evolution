import { ComponentFixture, TestBed } from '@angular/core/testing';

import { Engine3DComponent } from './engine3-d.component';

describe('Engine3DComponent', () => {
  let component: Engine3DComponent;
  let fixture: ComponentFixture<Engine3DComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      declarations: [ Engine3DComponent ]
    })
    .compileComponents();
  });

  beforeEach(() => {
    fixture = TestBed.createComponent(Engine3DComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
