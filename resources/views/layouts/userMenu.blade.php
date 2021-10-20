<div x-show="userMenu" @click.away="userMenu = false" class="absolute z-50 bg-white rounded-lg shadow-lg px-5 py-3 w-full text-sm border-t border-gray-200 text-gray-600">
    <ul class="my-2">
        <li>
            <a href="{{ route('profile.purchases') }}" class="flex items-center">
                <svg class="w-4 h-4" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 512 512"
                    style="enable-background:new 0 0 512 512;" xml:space="preserve">
                    <g>
                        <g>
                            <path d="M488.542,174.916H293.737V27.028c0-10.686-8.693-19.378-19.378-19.378h-36.717c-10.686,0-19.378,8.693-19.378,19.378
			v147.888H23.458C10.524,174.916,0,185.439,0,198.375v50.57c0,12.936,10.524,23.458,23.458,23.458h3.375L53.27,460.293
			c3.534,25.117,25.327,44.057,50.691,44.057h304.076c25.365,0,47.157-18.941,50.691-44.057l26.438-187.891h3.375
			c12.936,0,23.458-10.523,23.458-23.458v-50.57C512,185.439,501.478,174.916,488.542,174.916z M238.661,28.048h34.677v194.805
			h-34.677V28.048z M438.53,457.451c-2.125,15.108-15.235,26.502-30.492,26.502H103.961c-15.257,0-28.366-11.393-30.492-26.502
			L47.432,272.402h417.135L438.53,457.451z M491.602,248.944c0,1.687-1.373,3.06-3.06,3.06H23.458c-1.687,0-3.06-1.373-3.06-3.06
			v-50.57c0-1.687,1.373-3.06,3.06-3.06h194.805v28.558c0,10.686,8.693,19.378,19.378,19.378h36.717
			c10.686,0,19.378-8.693,19.378-19.378v-28.558h194.805c1.687,0,3.06,1.373,3.06,3.06V248.944z" />
                        </g>
                    </g>
                    <g>
                        <g>
                            <path d="M110.151,296.287c-5.633,0-10.199,4.567-10.199,10.199v142.789c0,5.632,4.566,10.199,10.199,10.199
			c5.633,0,10.199-4.567,10.199-10.199V306.486C120.351,300.854,115.784,296.287,110.151,296.287z" />
                        </g>
                    </g>
                    <g>
                        <g>
                            <path d="M168.491,296.287c-5.633,0-10.199,4.567-10.199,10.199v142.789c0,5.632,4.566,10.199,10.199,10.199
			s10.199-4.567,10.199-10.199V306.486C178.69,300.854,174.124,296.287,168.491,296.287z" />
                        </g>
                    </g>
                    <g>
                        <g>
                            <path d="M226.83,296.287c-5.633,0-10.199,4.567-10.199,10.199v142.789c0,5.632,4.566,10.199,10.199,10.199
			c5.633,0,10.199-4.567,10.199-10.199V306.486C237.029,300.854,232.463,296.287,226.83,296.287z" />
                        </g>
                    </g>
                    <g>
                        <g>
                            <path d="M285.17,296.287c-5.632,0-10.199,4.567-10.199,10.199v142.789c0,5.632,4.566,10.199,10.199,10.199
			c5.632,0,10.199-4.567,10.199-10.199V306.486C295.369,300.854,290.802,296.287,285.17,296.287z" />
                        </g>
                    </g>
                    <g>
                        <g>
                            <path d="M343.509,296.287c-5.632,0-10.199,4.567-10.199,10.199v142.789c0,5.632,4.566,10.199,10.199,10.199
			c5.632,0,10.199-4.567,10.199-10.199V306.486C353.708,300.854,349.141,296.287,343.509,296.287z" />
                        </g>
                    </g>
                    <g>
                        <g>
                            <path d="M401.849,296.287c-5.632,0-10.199,4.567-10.199,10.199v8.164c0,5.632,4.567,10.199,10.199,10.199
			c5.632,0,10.199-4.567,10.199-10.199v-8.164C412.048,300.854,407.481,296.287,401.849,296.287z" />
                        </g>
                    </g>
                    <g>
                        <g>
                            <path d="M401.849,343.204c-5.632,0-10.199,4.567-10.199,10.199v95.871c0,5.632,4.567,10.199,10.199,10.199
			c5.632,0,10.199-4.567,10.199-10.199v-95.871C412.048,347.771,407.481,343.204,401.849,343.204z" />
                        </g>
                    </g>
                </svg>
                <span class="ml-2"></span>
                مشترياتي
            </a>
        </li>
        <li class="mt-3">
            <a href="{{ route('address.index') }}" class="flex items-center">
                <svg class="w-4 h-4" id="Capa_1" enable-background="new 0 0 512 512" viewBox="0 0 512 512" xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="m377.9 352.896c-3.819-1.596-8.215.207-9.812 4.03-1.596 3.821.208 8.215 4.03 9.812 34.706 14.498 54.611 34.479 54.611 54.821 0 40.893-78.185 75.44-170.73 75.44s-170.729-34.547-170.729-75.439c0-25.563 32.216-50.539 82.518-64.318 34.009 45.294 67.684 82.923 78.24 94.5 2.552 2.799 6.187 4.403 9.973 4.403s7.421-1.604 9.972-4.402c12.101-13.271 54.577-60.768 93.113-114.808 49.046-68.779 73.914-122.589 73.914-159.935 0-97.598-79.402-177-177-177-46.691 0-90.746 18.02-124.047 50.74-2.954 2.903-2.996 7.651-.093 10.606 2.903 2.956 7.651 2.997 10.606.093 30.478-29.946 70.799-46.439 113.534-46.439 89.327 0 162 72.673 162 162 0 33.68-24.596 85.973-71.128 151.226-36.95 51.815-77.601 97.573-90.872 112.188-13.271-14.613-53.922-60.372-90.872-112.188-46.532-65.253-71.128-117.546-71.128-151.226 0-31.662 9.133-62.331 26.411-88.69 2.271-3.464 1.304-8.114-2.161-10.384-3.462-2.27-8.113-1.304-10.384 2.161-18.885 28.809-28.866 62.321-28.866 96.913 0 37.346 24.868 91.156 73.915 159.935 1.776 2.491 3.563 4.963 5.353 7.423-23.999 7.117-44.363 16.812-59.344 28.308-18.746 14.386-28.654 31.293-28.654 48.894 0 25.24 20.078 48.483 56.536 65.449 34.632 16.116 80.513 24.991 129.194 24.991s94.562-8.875 129.194-24.991c36.458-16.966 56.536-40.209 56.536-65.449 0-27.083-22.668-51.468-63.83-68.664zm-121.9-103.824c52.935 0 96-43.065 96-96s-43.065-96-96-96-96 43.065-96 96 43.065 96 96 96zm0-177c44.663 0 81 36.336 81 81s-36.337 81-81 81-81-36.336-81-81 36.337-81 81-81zm-22.5 103.5v30c0 7.444 6.056 13.5 13.5 13.5h18c7.444 0 13.5-6.056 13.5-13.5v-30h30c7.444 0 13.5-6.056 13.5-13.5v-18c0-7.444-6.056-13.5-13.5-13.5h-30v-30c0-7.444-6.056-13.5-13.5-13.5h-18c-7.444 0-13.5 6.056-13.5 13.5v30h-30c-7.444 0-13.5 6.056-13.5 13.5v18c0 7.444 6.056 13.5 13.5 13.5zm-28.5-30h33c5.79 0 10.5-4.71 10.5-10.5v-33h15v33c0 5.79 4.71 10.5 10.5 10.5h33v15h-33c-5.79 0-10.5 4.71-10.5 10.5v33h-15v-33c0-5.79-4.71-10.5-10.5-10.5h-33z" />
                </svg>
                <span class="ml-2"></span>
                عناويني
            </a>
        </li>
        <li>
            <hr class="mt-4">
        </li>
        <li class="mt-3">
            <form action="{{ route('logout') }}" method="post">
                @csrf
                <button type="submit" class="flex items-center">
                    <svg class="w-4 h-4" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                        viewBox="0 0 511.989 511.989" style="enable-background:new 0 0 511.989 511.989;" xml:space="preserve">
                        <g>
                            <g>
                                <g>
                                    <path d="M110.933,221.782c-4.71,0-8.533,3.823-8.533,8.533v51.2c0,4.71,3.823,8.533,8.533,8.533s8.533-3.823,8.533-8.533v-51.2
				C119.467,225.605,115.644,221.782,110.933,221.782z" />
                                    <path d="M111.855,2.304L31.172,34.586C8.448,43,0,54.418,0,76.715v358.477c0,22.298,8.448,33.715,30.959,42.061l81.058,32.427
				c4.011,1.519,8.038,2.287,11.981,2.287c17.152,0,29.602-14.336,29.602-34.091V34.049C153.6,9.78,134.246-6.126,111.855,2.304z
				 M136.533,477.876c0,10.18-5.035,17.024-12.535,17.024c-1.869,0-3.883-0.401-5.803-1.118L37.103,461.33
				c-16.102-5.965-20.036-11.102-20.036-26.138V76.715c0-15.036,3.934-20.164,20.241-26.206l80.725-32.29
				c2.082-0.785,4.087-1.186,5.956-1.186c7.501,0,12.544,6.835,12.544,17.016V477.876z" />
                                    <path d="M178.133,51.115h120.533c14.114,0,25.6,11.486,25.6,25.6v128c0,4.71,3.814,8.533,8.533,8.533
				c4.719,0,8.533-3.823,8.533-8.533v-128c0-23.526-19.14-42.667-42.667-42.667H178.133c-4.71,0-8.533,3.823-8.533,8.533
				S173.423,51.115,178.133,51.115z" />
                                    <path d="M332.8,298.582c-4.719,0-8.533,3.823-8.533,8.533v128c0,14.114-11.486,25.6-25.6,25.6H179.2
				c-4.71,0-8.533,3.823-8.533,8.533s3.823,8.533,8.533,8.533h119.467c23.526,0,42.667-19.14,42.667-42.667v-128
				C341.333,302.405,337.519,298.582,332.8,298.582z" />
                                    <path d="M511.343,252.655c-0.435-1.05-1.058-1.988-1.852-2.782l-85.325-85.333c-3.337-3.336-8.73-3.336-12.066,0
				c-3.337,3.337-3.337,8.73,0,12.066l70.767,70.775H196.267c-4.71,0-8.533,3.823-8.533,8.533c0,4.71,3.823,8.533,8.533,8.533
				h286.601L412.1,335.215c-3.337,3.337-3.337,8.73,0,12.066c1.664,1.664,3.849,2.5,6.033,2.5c2.185,0,4.369-0.836,6.033-2.5
				l85.325-85.325c0.794-0.794,1.417-1.732,1.852-2.782C512.205,257.093,512.205,254.738,511.343,252.655z" />
                                </g>
                            </g>
                        </g>
                    </svg>

                    <span class="ml-1"></span>
                    تسجيل الخروج
                </button>
            </form>
        </li>
    </ul>
</div>