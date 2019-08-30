<div class="row">
    <div class="col-md-8">
        <div class="form-group row">
            <label for="title" class="col-md-2 col-form-label">
                标题
            </label>
            <div class="col-md-10">
                <input v-model="list.title" type="text" class="form-control" name="title" autofocus id="title"
                       value="{{ $title }}">
            </div>
        </div>
        <div class="form-group row">
            <label for="slug" class="col-md-2 col-form-label">
                seo
            </label>
            <div class="col-md-10">
                <input v-model="list.slug" type="text" class="form-control" name="slug" autofocus id="slug"
                       value="{{ $slug }}">
            </div>
        </div>
        <div class="form-group row">
            <label for="subtitle" class="col-md-2 col-form-label">
                副标题
            </label>
            <div class="col-md-10">
                <input v-model="list.subtitle" type="text" class="form-control" name="subtitle" id="subtitle"
                       value="{{ $subtitle }}">
            </div>
        </div>
        <div class="form-group row">
            <label for="page_image" class="col-md-2 col-form-label">
                缩略图
            </label>
            <div class="col-md-10">
                <div class="row">
                    <div class="col-md-8">
                        <input v-model="list.page_image" type="text" class="form-control" name="page_image"
                               id="page_image"
                               alt="Image thumbnail" value="{{ $page_image }}">
                    </div>
                    <div class="visible-sm space-10"></div>
                    <div class="col-md-4 text-right">
                        <img src="" class="img img_responsive" id="page-image-preview" style="max-height:40px">
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group row">
            <label for="content" class="col-md-2 col-form-label">
                内容
            </label>
            <div class="col-md-10">
                <textarea v-model="list.content" class="form-control" name="content" rows="14"
                          id="content">{{ $content }}</textarea>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group row">
            <label for="publish_date" class="col-md-8 col-form-label">
                发布日期
            </label>
            <div class="col-md-8">
                <input v-model="list.publish_date" class="form-control" name="publish_date" id="publish_date"
                       type="text"
                       value="{{ $publish_date }}">
            </div>
        </div>
        <div class="form-group row">
            <label for="publish_time" class="col-md-8 col-form-label">
                发布时间
            </label>
            <div class="col-md-8">
                <input v-model="list.publish_time" class="form-control" name="publish_time" id="publish_time"
                       type="text"
                       value="{{ $publish_time }}">
            </div>
        </div>
        <div class="form-group row">
            <div class="col-md-8 col-md-offset-3">
                <div class="checkbox">
                    <label>
                        <input v-model="list.is_draft" {{ checked($is_draft) }} type="checkbox" name="is_draft">
                        草稿?
                    </label>
                </div>
            </div>
        </div>
        <div class="form-group row">
            <label for="tags" class="col-md-8 col-form-label">
                标签
            </label>
            <div class="col-md-8">
                <select v-model="list.tags" name="tags[]" id="tags" class="form-control" multiple>
                    <option v-for="tag in tags.data" v-bind:value="tag.id"> @{{ tag.tag }} </option>
                </select>
            </div>
        </div>
        <div class="form-group row">
            <label for="layout" class="col-md-8 col-form-label">
                布局
            </label>
            <div class="col-md-8">
                <input v-model="list.layout" type="text" class="form-control" name="layout" id="layout"
                       value="{{ $layout }}">
            </div>
        </div>
        <div class="form-group row">
            <label for="meta_description" class="col-md-8 col-form-label">
                摘要
            </label>
            <div class="col-md-8">
                <textarea v-model="list.meta_description" class="form-control" name="meta_description"
                          id="meta_description"
                          rows="6">{{ $meta_description }}</textarea>
            </div>
        </div>

    </div>
</div>