import { mount } from '@vue/test-utils'
import AppBarTop from '@/components/AppBarTop.vue'


describe('AppBarTop unit testing: ', () => {
  test('is a Vue instance', () => {
    const wrapper = mount(AppBarTop);

    expect(wrapper.isVueInstance()).toBeTruthy();
  })

  
})
