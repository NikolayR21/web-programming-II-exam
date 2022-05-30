import { mount } from '@vue/test-utils'
import AppBarTop from '@/components/AppBarTop.vue'

describe('AppBarTop unit testing: ', () => {
  it('is a Vue instance', () => {
    const wrapper = mount(AppBarTop);

    expect(wrapper.isVueInstance()).toBeTruthy();
  })

  it('contains an img', () => {
    const wrapper = mount(AppBarTop);

    expect(wrapper.contains('img')).toBeTruthy();
  })
})
