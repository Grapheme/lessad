{{ Form::open(array('url'=>link::auth('reviews/store'),'role'=>'form','class'=>'smart-form','id'=>'review-form','method'=>'post')) }}


<div class="well">
    <header>Для создания отзыва заполните форму:</header>
    <fieldset>

        <section>
            <label class="label">
                Идентификатор отзыва
                <div class="note">Может содержать <strong>только</strong> английские буквы в нижнем регистре, цифры, знаки подчеркивания и тире</div>
            </label>
            <label class="input col-5"> <i class="icon-append fa fa-list-alt"></i>
                {{ Form::text('slug','') }}
            </label>
        </section>

        @if(Allow::module('templates'))
        <section>
            <label class="label">Шаблон отзыва:</label>
            <label class="select col-5">
                @foreach($templates as $template)
                <?php $temps[$template->name] = $template->name;?>
                @endforeach
                {{ Form::select('template', $temps, 'reviews', array('class'=>'template-change','autocomplete'=>'off')) }} <i></i>
            </label>
        </section>
        @endif

        <section>
            <label class="label">Дата публикации:</label>
            <label class="select col-5">
                <input type="text" name="published_at" value="<?=date('d.m.Y')?>" class="datepicker" />
            </label>
        </section>

    </fieldset>
</div>


<!-- Tabs -->
<ul class="nav nav-tabs margin-top-10">
    @foreach ($locales as $l => $locale)
    <li class="{{ $l === 0 ? 'active' : '' }}">
        <a href="#lang_{{ $locale }}" data-toggle="tab">{{ $locale }}</a>
    </li>
    @endforeach
</ul>


<!-- Fields -->
<div class="row margin-top-10">
    <div class="tab-content">
        @foreach ($locales as $l => $locale)
        <div class="tab-pane{{ $l === 0 ? ' active' : '' }}" id="lang_{{ $locale }}">

            <!-- Form -->
            <section class="col col-6">
                <div class="well">
                    <header>{{ $locale }}-версия:</header>
                    <fieldset>
                        <section>
                            <label class="label">Имя отправителя</label>
                            <label class="input"> <i class="icon-append fa fa-list-alt"></i>
                                {{ Form::text('name['.$locale.']','') }}
                            </label>
                        </section>
                        <section>
                            <label class="label">Должность отправителя</label>
                            <label class="input"> <i class="icon-append fa fa-list-alt"></i>
                                {{ Form::text('position['.$locale.']','') }}
                            </label>
                        </section>
                        @if (Allow::module('galleries'))
                        <section>
                            <label class="label">Изображение</label>
                            <label class="input">
                                {{ ExtForm::image('photo', '') }}
                            </label>
                        </section>
                        @endif
                        <section>
                            <label class="label">Содержание</label>
                            <label class="textarea">
                                {{ Form::textarea('content['.$locale.']','',array('class'=>'redactor redactor_450')) }}
                            </label>
                        </section>
                    </fieldset>
                </div>
            </section>
        </div>
        @endforeach
    </div>
</div>

<div style="float:none; clear:both;"></div>

@if(Allow::enabled_module('galleries') && 0)
<section class="col-12">
    @include('modules.galleries.abstract')
    @include('modules.galleries.uploaded', array('gallery' => $gall))
</section>
@endif

<section class="col-6">
    <footer>
        <a class="btn btn-default no-margin regular-10 uppercase pull-left btn-spinner" href="{{URL::previous()}}">
            <i class="fa fa-arrow-left hidden"></i> <span class="btn-response-text">Назад</span>
        </a>
        <button type="submit" autocomplete="off" class="btn btn-success no-margin regular-10 uppercase btn-form-submit">
            <i class="fa fa-spinner fa-spin hidden"></i> <span class="btn-response-text">Создать</span>
        </button>
    </footer>
</section>


{{ Form::close() }}
