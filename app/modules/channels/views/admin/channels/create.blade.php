@extends(Helper::acclayout())


@section('style')
    <link rel="stylesheet" href="{{ link::path('css/redactor.css') }}" />
@stop


@section('content')

    <h1>Информационные блоки: Новый элемент</h1>

{{ Form::open(array('url'=>link::auth($module['rest'].'/store'), 'role'=>'form', 'class'=>'smart-form', 'id'=>'channel-form', 'method'=>'post', 'files'=>true)) }}
	<div class="row margin-top-10">
		<section class="col col-6">
			<div class="well">
				<header>Для создания нового элемента заполните форму:</header>
				<fieldset>
					<section>
						<label class="label">Название</label>
						<label class="input">
							{{ Form::text('title', '') }}
						</label>
					</section>
                    <section>
						<label class="label">Ссылка</label>
						<label class="input">
							{{ Form::text('link', '') }}
						</label>
                        <div class="note">Относительная ссылка если в предалах сайта или полная если это другой сайт</div>
					</section>

					<section>
						<label class="label">Категория</label>
						<label class="select">
							{{ Form::select('category_id', $categories, ($cat > 0 ? $cat : '' ) ) }}
						</label>
					</section>

                    @if(Allow::module('templates') || 1)
                    <section>
                        <label class="label">Шаблон:</label>
                        <label class="select col-5">
                            {{ Form::select('template', $templates,'default', array('class'=>'template-change','autocomplete'=>'off')) }} <i></i>
                        </label>
                    </section>
                    @endif

                    @if (Allow::module('galleries'))
                    <section>
                        <label class="label">Изображение</label>
                        <label class="input">
                            {{ ExtForm::image('image', '') }}
                        </label>
                    </section>
                    @endif

					<section>
						<label class="label">Краткое описание</label>
						<label class="textarea">
							{{ Form::textarea('short', '') }}
						</label>
					</section>
                    <section>
						<label class="label">Описание</label>
						<label class="textarea">
							{{ Form::textarea('desc', '',array('class'=>'redactor')) }}
						</label>
					</section>

                    <section>
                        <label class="label">Файл</label>
                        <label class="input input-file" for="file">
                            <div class="button"><input type="file" onchange="this.parentNode.nextSibling.value = this.value" name="file">Выбрать</div><input type="text" readonly="">
                        </label>
                    </section>
                    <section>
                        <label class="label">Порядковый номер</label>
                        <label class="input">
                            {{ Form::text('sort',0) }}
                        </label>
                    </section>
                </fieldset>
				<footer>
					<a class="btn btn-default no-margin regular-10 uppercase pull-left btn-spinner" href="{{URL::previous()}}">
						<i class="fa fa-arrow-left hidden"></i> <span class="btn-response-text">Назад</span>
					</a>
					<button type="submit" autocomplete="off" class="btn btn-success no-margin regular-10 uppercase btn-form-submit">
						<i class="fa fa-spinner fa-spin hidden"></i> <span class="btn-response-text">Создать</span>
					</button>
				</footer>
			</div>
		</section>
	</div>
{{ Form::close() }}
@stop


@section('scripts')
    <script>
    var essence = 'channel';
    var essence_name = 'элемент';
	var validation_rules = {
		title: { required: true },
		category_id: { required: true, min: 1 },
		//desc: { required: true },
		//image: { required: true },
	};
	var validation_messages = {
		title: { required: 'Укажите название' },
		category_id: { required: 'Укажите категорию', min: 'Укажите категорию' },
		//desc: { required: 'Укажите описание' },
		//image: { required: 'Загрузите изображение' },
	};
    </script>

    {{ HTML::script('js/modules/standard.js') }}

	<script type="text/javascript">
		if(typeof pageSetUp === 'function'){pageSetUp();}
		if(typeof runFormValidation === 'function'){
			loadScript("{{ asset('js/vendor/jquery-form.min.js') }}", runFormValidation);
		}else{
			loadScript("{{ asset('js/vendor/jquery-form.min.js') }}");
		}
	</script>

    {{ HTML::script('js/modules/gallery.js') }}
    {{ HTML::script('js/vendor/redactor.min.js') }}
    {{ HTML::script('js/system/redactor-config.js') }}

@stop